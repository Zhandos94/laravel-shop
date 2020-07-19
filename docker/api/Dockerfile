FROM php:7.3-fpm

# Set working directory
WORKDIR /var/www/sites/shop/
ENV WORKDIR=/var/www/sites/shop/

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    && pecl install xdebug \
    docker-php-ext-enable xdebug \
    && docker-php-ext-install bcmath sockets


# Copy xdebug.ini
COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc && \
        composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl
RUN docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/
RUN docker-php-ext-install gd

# Copy existing application directory contents
COPY . /var/www/sites/shop/

RUN mkdir -p /var/www/storage/logs \
    && chmod -R 0777 /var/www/storage/logs \
    && mkdir -p $WORKDIR

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

