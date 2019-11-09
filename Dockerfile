# Authors: Shayna Jamieson, Keller Flint, Bridget Black
# 2019-10-16
# Last Updated: 2019-10-29
# File: Dockerfile
# Associated Files: volunteer_form.php
#                  youth_form.php
FROM php:7.2-apache
COPY . /var/www/html/
WORKDIR /var/www/html/
RUN apt-get update && apt-get install -y && docker-php-ext-install mysqli && docker-php-ext-enable mysqli
CMD /usr/sbin/apache2ctl -D FOREGROUND
