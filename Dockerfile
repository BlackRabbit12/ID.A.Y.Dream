FROM php:7.2-apache
COPY . /var/www/html/
WORKDIR /var/www/html/
RUN apt-get update && apt-get install -y && docker-php-ext-install mysqli && docker-php-ext-enable mysqli
CMD /usr/sbin/apache2ctl -D FOREGROUND