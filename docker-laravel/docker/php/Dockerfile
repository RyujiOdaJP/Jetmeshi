FROM php:7.4-fpm-alpine
LABEL maintainer="RyujiOdaJP <ryuji.oda@gmail.com>"

SHELL ["/bin/ash", "-oeux", "pipefail", "-c"]

# tinker(psysh)
ARG PSYSH_DIR=/usr/local/share/psysh
ARG PSYSH_PHP_MANUAL=$PSYSH_DIR/php_manual.sqlite
ARG PHP_MANUAL_URL=http://psysh.org/manual/ja/php_manual.sqlite

# timezone
ARG TZ

# composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer

# Node.jsをインストール
RUN apk add --update nodejs nodejs-npm

RUN apk update && \
  apk add --update --no-cache --virtual=.build-dependencies \
    autoconf=~2.69 \
    gcc=~9.3 \
    g++=~9.3 \
    make=~4.3 \
    git=~2.26 && \
  # for gd
  apk add --update --no-cache \
    freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev && \
  # gd
  docker-php-ext-install -j$(nproc) iconv && \
  docker-php-ext-configure gd --with-freetype --with-jpeg && \
  docker-php-ext-install -j$(nproc) gd && \
  apk add --update --no-cache \
    icu-dev=~67.1 \
    libzip-dev=~1.6 \
    oniguruma-dev=~6.9 && \
  pecl install xdebug && \
  # git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis && \
  apk del .build-dependencies && \
  # docker-php-ext-install intl pdo_mysql mbstring zip bcmath redis && \
  docker-php-ext-install intl pdo_mysql mbstring zip bcmath && \
  docker-php-ext-enable xdebug && \
  mkdir $PSYSH_DIR && curl $PHP_MANUAL_URL -o $PSYSH_PHP_MANUAL && \
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer && \
  composer config -g process-timeout 3600 && \
  composer config -g repos.packagist composer https://packagist.jp && \
  composer global require hirak/prestissimo
