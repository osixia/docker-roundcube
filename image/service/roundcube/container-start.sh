#!/bin/bash -e

FIRST_START_DONE="/etc/docker-roundcube-first-start-done"

# container first start
if [ ! -e "$FIRST_START_DONE" ]; then

  # create roundcube vhost
  if [ "${ROUNDCUBE_HTTPS,,}" == "true" ]; then

    # check certificat and key or create it
    /sbin/ssl-helper "/container/service/roundcube/assets/apache2/certs/$ROUNDCUBE_HTTPS_CRT_FILENAME" "/container/service/roundcube/assets/apache2/certs/$ROUNDCUBE_HTTPS_KEY_FILENAME" --ca-crt=/container/service/roundcube/assets/apache2/certs/$ROUNDCUBE_HTTPS_CA_CRT_FILENAME

    # add CA certificat config if CA cert exists
    if [ -e "--ca-crt=/container/service/roundcube/assets/apache2/certs/$ROUNDCUBE_HTTPS_CA_CRT_FILENAME" ]; then
      sed -i "s/#SSLCACertificateFile/SSLCACertificateFile/g" /container/service/roundcube/assets/apache2/roundcube-ssl.conf
    fi

    a2ensite roundcube-ssl

  else
    a2ensite roundcube
  fi

  # roundcube directory is empty, we use the bootstrap
  if [ ! "$(ls -A /var/www/roundcube)" ]; then
    cp -R /var/www/roundcube_bootstrap/. /var/www/roundcube
    rm -rf /var/www/roundcube_bootstrap
  fi

  if [ -e "/container/service/roundcube/assets/config.inc.php" ]; then
    echo "Container config file /container/service/roundcube/assets/config.inc.php found"

    if [ -e "/var/www/roundcube/config/config.inc.php" ]; then
      echo "RoundCube config file /var/www/roundcube/config/config.inc.php already exists "
      echo "-> Ignore container config file"
    else
      echo "RoundCube config file /var/www/roundcube/config/config.inc.php not found"
      echo "-> Copy container config file to config file /var/www/roundcube/config/config.inc.php"
      cp -f /container/service/roundcube/assets/config.inc.php /var/www/roundcube/config/config.inc.php
    fi
  fi

  echo "ROUNDCUBE_KEEP_INSTALLER=$ROUNDCUBE_KEEP_INSTALLER"
  if [ -e "/var/www/roundcube/config/config.inc.php" ] && [ "${ROUNDCUBE_KEEP_INSTALLER,,}" == "false" ]; then
    echo "RoundCube config file /var/www/roundcube/config/config.inc.php exists "
    echo "-> Delete installer"
    rm -rf /var/www/roundcube/installer
  fi

  touch $FIRST_START_DONE
fi

# Fix file permission
find /var/www/ -type d -exec chmod 755 {} \;
find /var/www/ -type f -exec chmod 644 {} \;
chown www-data:www-data -R /var/www

exit 0
