FROM osixia/web-baseimage:0.1.6
MAINTAINER Bertrand Gouny <bertrand.gouny@osixia.net>

# roundcube version
ENV ROUNDCUBE_VERSION 1.1.3
ENV ROUNDCUBE_SHA256 f0d3e0f86cded38c02e0dfb3b5b875d48dd873865593ab3759e04b5fe056a9d9

# MariaDB version
ENV MARIADB_MAJOR 10.1

# Use baseimage's init system.
# https://github.com/osixia/docker-light-baseimage/blob/stable/image/tool/run
CMD ["/container/tool/run"]

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
		&& /container/tool/install-multiple-process-stack \
		&& /container/tool/install-service-available apache2 php5-fpm ssl-helper-openssl \
		&& LC_ALL=C DEBIAN_FRONTEND=noninteractive apt-get install -y --no-install-recommends \
			 php-gettext \
			 php5-json \
			 php5-mcrypt \
			 php5-mysql \
       php5-pgsql \
       php5-sqlite \
       php5-intl \
       php5-ldap \
       php5-enchant \
       php-pear \
       php5-gd \
       php-apc \
       aspell \
       aspell-en \
       aspell-fr \
			 curl \
		&& curl -o roundcube.tar.gz -SL http://downloads.sourceforge.net/project/roundcubemail/roundcubemail/${ROUNDCUBE_VERSION}/roundcubemail-${ROUNDCUBE_VERSION}-complete.tar.gz \
		&& echo "$ROUNDCUBE_SHA256 *roundcube.tar.gz" | sha256sum -c - \
		&& mkdir -p /var/www/roundcube_bootstrap /var/www/roundcube \
		&& tar -xzf roundcube.tar.gz --strip 1 -C /var/www/roundcube_bootstrap \
		&& apt-get remove -y --purge --auto-remove curl

# Add service directory to /container/service
ADD service /container/service

# Use baseimage install-service script and clean all
# https://github.com/osixia/docker-light-baseimage/blob/stable/image/tool/install-service
RUN /container/tool/install-service \
		&& rm roundcube.tar.gz \
		&& apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Add default env variables
ADD env.yaml /container/environment/env.yaml

# Set wordpress data directory in a data volume
VOLUME ["/var/www/roundcube"]

# Expose http and https default ports
EXPOSE 80 443
