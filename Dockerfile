FROM php:8.0-fpm-buster

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install packages
RUN apt update && apt install -y zip curl fcgiwrap && \
    mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

ENV USER=azure-oss
ENV UID=10000
ENV GID=10001

RUN addgroup \
    --gid $GID \
    --system $USER \
    && adduser \
    --uid $UID \
    --disabled-password \
    --gecos "" \
    --ingroup $USER \
    $USER \
    && mkdir -p /app \
    && chown -R $UID:$GID /app

# Add configuration files for PHP and PHPFPM
COPY ./.docker/www.conf /usr/local/etc/php-fpm.d/

ARG UID=${UID:-10000}
ARG GID=${GID:-10001}
ARG USER=${USER:-azure-oss}
RUN usermod -u $UID $USER && groupmod -g $GID $USER

WORKDIR /app







WORKDIR /app
