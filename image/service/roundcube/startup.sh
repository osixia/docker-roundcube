#!/bin/bash -e

# set -x (bash debug) if log level is trace
# https://github.com/osixia/docker-light-baseimage/blob/stable/image/tool/log-helper
log-helper level eq trace && set -x

#
# HTTPS config
#
if [ "${ROUNDCUBE_HTTPS,,}" == "true" ]; then

  log-helper info "Set apache2 https config..."

  # generate a certificate and key if files don't exists
  # https://github.com/osixia/docker-light-baseimage/blob/stable/image/service-available/:cfssl/assets/tool/cfssl-helper
  cfssl-helper ${ROUNDCUBE_CFSSL_PREFIX} "${CONTAINER_SERVICE_DIR}/roundcube/assets/apache2/certs/$ROUNDCUBE_HTTPS_CRT_FILENAME" "${CONTAINER_SERVICE_DIR}/roundcube/assets/apache2/certs/$ROUNDCUBE_HTTPS_KEY_FILENAME" "${CONTAINER_SERVICE_DIR}/roundcube/assets/apache2/certs/$ROUNDCUBE_HTTPS_CA_CRT_FILENAME"

  # add CA certificat config if CA cert exists
  if [ -e "${CONTAINER_SERVICE_DIR}/roundcube/assets/apache2/certs/$ROUNDCUBE_HTTPS_CA_CRT_FILENAME" ]; then
    sed -i "s/#SSLCACertificateFile/SSLCACertificateFile/g" ${CONTAINER_SERVICE_DIR}/roundcube/assets/apache2/https.conf
  fi

  ln -sf ${CONTAINER_SERVICE_DIR}/roundcube/assets/apache2/https.conf /etc/apache2/sites-available/roundcube.conf
#
# HTTP config
#
else
  log-helper info "Set apache2 http config..."
  ln -sf ${CONTAINER_SERVICE_DIR}/roundcube/assets/apache2/http.conf /etc/apache2/sites-available/roundcube.conf
fi

a2ensite roundcube | log-helper debug

# roundcube directory is empty, we use the bootstrap
if [ ! "$(ls -A /var/www/roundcube)" ]; then

  log-helper info "Use bootstrap"
  cp -R /var/www/roundcube_bootstrap/. /var/www/roundcube
  rm -rf /var/www/roundcube_bootstrap

  # add skins and plugins
  cp -R ${CONTAINER_SERVICE_DIR}/roundcube/assets/bootstrap/. /var/www/roundcube
  rm -rf ${CONTAINER_SERVICE_DIR}/roundcube/assets/bootstrap

fi

log-helper info "ROUNDCUBE_KEEP_INSTALLER=$ROUNDCUBE_KEEP_INSTALLER"
if [ -e "/var/www/roundcube/config/config.inc.php" ] && [ "${ROUNDCUBE_KEEP_INSTALLER,,}" == "false" ]; then
  log-helper info "RoundCube config file /var/www/roundcube/config/config.inc.php exists "
  log-helper info "-> Delete installer"
  rm -rf /var/www/roundcube/installer
fi

# if there is no config file link service config
if [ ! -e "/var/www/roundcube/config/config.inc.php" ]; then
  log-helper debug  "link ${CONTAINER_SERVICE_DIR}/roundcube/assets/config.inc.php to /var/www/roundcube/config/config.inc.php"
  ln -sf ${CONTAINER_SERVICE_DIR}/roundcube/assets/config.inc.php /var/www/roundcube/config/config.inc.php
fi

# Fix file permission
find /var/www/ -type d -exec chmod 755 {} \;
find /var/www/ -type f -exec chmod 644 {} \;
chown www-data:www-data -R /var/www
chown www-data:www-data ${CONTAINER_SERVICE_DIR}/roundcube/assets/config.inc.php

exit 0
