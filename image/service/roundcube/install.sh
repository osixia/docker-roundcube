#!/bin/bash -e
# this script is run during the image build

# add roundcube virtualhosts
ln -s /container/service/roundcube/assets/apache2/roundcube.conf /etc/apache2/sites-available/roundcube.conf
ln -s /container/service/roundcube/assets/apache2/roundcube-ssl.conf /etc/apache2/sites-available/roundcube-ssl.conf

cat /container/service/roundcube/assets/php5-fpm/pool.conf >> /etc/php5/fpm/pool.d/www.conf
rm /container/service/roundcube/assets/php5-fpm/pool.conf

mkdir -p /var/www/tmp
chown www-data:www-data /var/www/tmp

# remove apache default host
a2dissite 000-default
rm -rf /var/www/html

# fix php5-fpm $_SERVER['SCRIPT_NAME'] bad value with cgi.fix_pathinfo=0
sed -i "s|dirname(\$_SERVER\['SCRIPT_FILENAME'\]).'/'|'/var/www/roundcube'/|g" /var/www/roundcube_bootstrap/program/include/iniset.php

sed -i "s/'SCRIPT_FILENAME'/'PATH_INFO'/g" /var/www/roundcube_bootstrap/program/include/rcmail.php
sed -i "s/\$_SERVER\['SCRIPT_NAME'\]/substr(\$_SERVER\['REQUEST_URI'\], 0, strpos(\$_SERVER\['REQUEST_URI'\], '\?'))/g" /var/www/roundcube_bootstrap/program/include/rcmail.php
