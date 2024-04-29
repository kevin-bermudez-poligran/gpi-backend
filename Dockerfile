FROM php:7.4-apache
RUN a2enmod rewrite
RUN apt-get update && apt-get install -y zip unzip curl && curl -sS https://getcomposer.org/installer | php && chmod +x composer.phar && mv composer.phar /usr/local/bin/composer

RUN  docker-php-ext-configure pcntl --enable-pcntl

RUN docker-php-ext-install \
    pdo_mysql \
    pcntl \
    sockets

#RUN yes | pecl install xdebug

#COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

#ARG CURRENT_IP_FOR_XDEBUG

#RUN sed -i "s/IP_XDEBUG/${CURRENT_IP_FOR_XDEBUG}/g" "/usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini"

#RUN docker-php-ext-enable xdebug

RUN mkdir /var/www/uploads

WORKDIR /var/www/html/
COPY composer.json composer.lock ./ 

CMD bash -c "composer install && apache2-foreground"
