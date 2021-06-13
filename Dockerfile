FROM php:8.0-fpm

WORKDIR /var/www

RUN apt-get update && \
    apt-get install -y --no-install-recommends libzip-dev git zip unzip && \
    docker-php-ext-install pdo pdo_mysql

RUN apt-get clean

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /var/www

COPY --chown=www:www . /var/www

USER www

EXPOSE 9000

CMD ["php-fpm"]