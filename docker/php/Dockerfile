FROM phpdockerio/php:8.1-fpm
WORKDIR "/artscure"


#RUN #apt-get update; \
#    apt-get -y --no-install-recommends install \
#        php8.1-bcmath \
#        php8.1-mysql \
#        php8.1-pgsql;

RUN docker-php-ext-configure pdo_mysql && \
    docker-php-ext-configure bcmath && \
    docker-php-ext-install pdo_mysql pdo_pgsql zip opcache exif gd intl sockets bcmath;

RUN apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

