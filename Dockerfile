FROM php:8-fpm

ARG user
ARG uid

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y nodejs 
RUN chmod +x /home
# Add composer to improve loading speed since its located inside linux

RUN chmod -R 777 /var/www & \
    mkdir /var/www/html/src & \
    ln -s /var/www/html/src /var/www/src

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user
WORKDIR /var/www/html

# Create the /var/www/storage directory and set ownership
RUN mkdir -p /var/www/storage && \
    chown -R $user:www-data /var/www/storage

USER $user