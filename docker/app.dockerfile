FROM php:7.3-fpm-stretch

ENV DEBIAN_FRONTEND=noninteractive

# Install packages
RUN apt-get update && apt-get install -y --no-install-recommends \
    libmcrypt-dev mysql-client libmagickwand-dev libpng-dev supervisor

# Update PECL channel
RUN pecl channel-update pecl.php.net

# Install PECL extensions
RUN pecl install -o -f redis imagick xdebug

# Enable PHP extensions
RUN docker-php-ext-enable redis imagick xdebug

# Configure PHP extensions
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql bcmath opcache pcntl gd

# Clear caches
RUN apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /tmp/* \
    && rm -rf /var/tmp/*

# Setup config files
COPY config/php/conf.d/*.ini /usr/local/etc/php/conf.d/
COPY config/fpm/*.conf /usr/local/etc/php-fpm.d/
