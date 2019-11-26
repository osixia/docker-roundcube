FROM osixia/web-baseimage:release-1.2.0-dev

# roundcube version
ARG ROUNDCUBE_VERSION=1.4.1
ARG ROUNDCUBE_SHA256=640423d21e1aa733ddea7462f156e194b051f086a3f2a70430e0aa2c9b09b44a

# Install apache2 and php7.3-fpm using osixia/baseimage utils
# Caution: /container/tool/install-service-available arguments order is important
# php7.3-fpm install will detect apache2 and configure it
# Download, check integrity and unzip roundcube to /var/www/roundcube_bootstrap
RUN apt-get update \
  && /container/tool/add-multiple-process-stack \
  && /container/tool/add-service-available :apache2 :php7.3-fpm :ssl-tools \
  && LC_ALL=C DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
  aspell \
  aspell-en \
  aspell-fr \
  ca-certificates \
  curl \
  mariadb-client \
  php-enchant \
  php-gd \
  php-intl \
  php-json \
  php-ldap \
  php-mysql \
  php-pgsql \
  php-sqlite3 \
  php-apcu \
  php-gettext \
  php-pear \
  php-zip \
  && curl -o roundcube.tar.gz -SL https://github.com/roundcube/roundcubemail/releases/download/${ROUNDCUBE_VERSION}/roundcubemail-${ROUNDCUBE_VERSION}-complete.tar.gz \
  && echo "${ROUNDCUBE_SHA256} *roundcube.tar.gz" | sha256sum -c - \
  && mkdir -p /var/www/roundcube_bootstrap /var/www/roundcube \
  && tar -xzf roundcube.tar.gz --strip 1 -C /var/www/roundcube_bootstrap \
  && apt-get remove -y --purge --auto-remove curl \
  && rm roundcube.tar.gz \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Add service directory to /container/service
ADD service /container/service

# Use baseimage install-service script
# https://github.com/osixia/docker-light-baseimage/blob/stable/image/tool/install-service
RUN /container/tool/install-service

# Add default env variables
ADD environment /container/environment/99-default

# Set roundcube data directory in a data volume
VOLUME ["/var/www/roundcube", "/data/backup"]

# Expose http and https default ports
EXPOSE 80 443
