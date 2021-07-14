ARG PHP_VERSION=8.0

FROM php:${PHP_VERSION}-cli

LABEL mantainer="Igor Finagin <Igor@Finag.in>"

ARG LARAVEL_VERSION=8.0
ENV LARAVEL_VERSION=$LARAVEL_VERSION
ENV COMPOSER_MEMORY_LIMIT=-1
ENV COMPOSER=/tmp/composer-docker.json
ENV COMPOSER_VENDOR_DIR=/tmp/vendor
ENV COMPOSER_ALLOW_SUPERUSER=true
ENV XDEBUG_MODE=coverage

WORKDIR /tmp

RUN apt-get update \
    && apt-get install -y zip unzip \
    && curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs \
    && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && echo "deb https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list \
    && apt-get update \
    && apt-get install -y yarn \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    && pecl channel-update https://pecl.php.net/channel.xml \
    && (pecl install xdebug || pecl install xdebug-2.8.0) \
    && docker-php-ext-enable xdebug

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');" \
    && php -m | grep -i xdebug

RUN npm install -g doctoc

VOLUME ["/app", "${COMPOSER_VENDOR_DIR}"]
WORKDIR /app

COPY entrypoint /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

ENTRYPOINT ["entrypoint"]
CMD ["--help"]
