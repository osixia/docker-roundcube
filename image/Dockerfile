FROM osixia/web-baseimage:0.1.11
MAINTAINER Bertrand Gouny <bertrand.gouny@osixia.net>

# roundcube version
ENV ROUNDCUBE_VERSION 1.2.2
ENV ROUNDCUBE_SHA256 b919e797b8bf5ed34748d067dc281f45f29ad71dbad8904bdc0e2258912666ef

# MariaDB version
ENV MARIADB_MAJOR 10.1

# Install apache2 and php5-fpm using osixia/baseimage utils
# Caution: /container/tool/install-service-available arguments order is important
# php5-fpm install will detect apache2 and configure it

# Add MariaDB repository
RUN apt-key adv --recv-keys --keyserver keyserver.ubuntu.com 0xcbcb082a1bb943db \
    && echo "deb http://ftp.igh.cnrs.fr/pub/mariadb/repo/$MARIADB_MAJOR/debian jessie main" > /etc/apt/sources.list.d/mariadb.list \
    && { \
		     echo 'Package: *'; \
		     echo 'Pin: release o=MariaDB'; \
		     echo 'Pin-Priority: 999'; \
	     } > /etc/apt/preferences.d/mariadb


# Download, check integrity and unzip roundcube to /var/www/roundcube_bootstrap
RUN apt-get update \
		&& /container/tool/add-multiple-process-stack \
		&& /container/tool/add-service-available :apache2 :php5-fpm :ssl-tools \
		&& LC_ALL=C DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
       aspell \
       aspell-en \
       aspell-fr \
       ca-certificates \
       curl \
       php5-enchant \
       php5-gd \
       php5-intl \
       php5-json \
       php5-ldap \
       php5-mcrypt \
       php5-mysql \
       php5-pgsql \
       php5-sqlite \
       php-apc \
       php-gettext \
       php-pear \
		&& curl -o roundcube.tar.gz -SL https://github.com/roundcube/roundcubemail/releases/download/${ROUNDCUBE_VERSION}/roundcubemail-${ROUNDCUBE_VERSION}-complete.tar.gz \
		&& echo "$ROUNDCUBE_SHA256 *roundcube.tar.gz" | sha256sum -c - \
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

# Set wordpress data directory in a data volume
VOLUME ["/var/www/roundcube"]

# Expose http and https default ports
EXPOSE 80 443
