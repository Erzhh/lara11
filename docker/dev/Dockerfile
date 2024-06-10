FROM unit:1.31.1-php8.2

# Set working directory
WORKDIR /var/www

# Устанавливаем необходимые расширения PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip zip \
    libonig-dev libpq-dev libfreetype6-dev \
    supervisor libxml2-dev libzip-dev  libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    libmagickwand-dev --no-install-recommends \
    && docker-php-ext-install opcache intl pdo_mysql pdo_pgsql pgsql mbstring exif pcntl bcmath xml zip iconv simplexml \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Copy the application
COPY . /var/www
COPY ./docker/dev/config.json /docker-entrypoint.d/
#COPY ./docker/dev/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./docker/dev/entrypoint.sh /usr/local/bin/start
COPY ./docker/dev/supervisor/supervisord.conf /etc/supervisor/supervisord.conf

RUN chmod +x /usr/local/bin/start

CMD ["/usr/local/bin/start"]
