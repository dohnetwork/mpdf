FROM nimmis/apache:14.04

MAINTAINER network <dohnetwork@gmail.com>

# disable interactive functions
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && \
apt-get install -y php5 libapache2-mod-php5  \
php5-fpm php5-cli php5-mysqlnd php5-pgsql php5-sqlite php5-redis \
php5-apcu php5-intl php5-imagick php5-mcrypt php5-json php5-gd php5-curl && \
php5enmod mcrypt && \
rm -rf /var/lib/apt/lists/* && \
cd /tmp && curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
#RUN usermod -u 1000 www-data
#RUN rm -rf /var/www/html 
#WORKDIR /var/www/html   
COPY --chown=www-data:www-data data/  /var/www/html/web
COPY --chown=www-data:www-data .  /var/www/html/web
#COPY . /var/www/html/web
#RUN ls -al /var/www/html/web
#RUN chown -R www-data:www-data /var/www/html 
RUN chmod -R 755 /var/www/html/web 

# ยังแก้ปัญาหาเรื่อง /var/www/html ไม่ได้
WORKDIR /var/www/html/web
RUN composer require mpdf/mpdf:5.7.0



COPY composer.json composer.json
COPY composer.lock composer.lock
COPY . /var/www/html/web


RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

