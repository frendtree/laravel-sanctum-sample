FROM php:7.4-fpm

RUN cd /usr/bin && curl -s https://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

RUN apt-get update \
  && apt-get install -y \
  git \
  zip \
  unzip \
  vim

RUN apt-get update \
  && apt-get install -y libpq-dev \
  && docker-php-ext-install pdo_mysql pdo_pgsql \
  && pecl install xdebug-2.9.8 \
  && docker-php-ext-enable xdebug

WORKDIR /var/www/html
