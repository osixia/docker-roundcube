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
