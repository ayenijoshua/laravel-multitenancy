# https://github.com/docker-library/php/blob/master/7.4/buster/fpm/Dockerfile
FROM php:7.4-fpm

LABEL maintainer="Joshua Ayeni"

# Arguments defined in docker-compose.yml
#ARG DOCKER_ENV=production
#ARG user=cmc
#ARG uid=1000

#RUN echo "Building Dockerfile for the ${DOCKER_ENV} environment..."

# Set working directory
WORKDIR /var/www/html

# Copy composer.lock and composer.json
#COPY composer.lock composer.json /var/www/


RUN apt-get update && apt-get install -y \
  sqlite3 \
  git \
  curl \
  libpng-dev \
  libonig-dev \
  libxml2-dev \
  zip \
  unzip

#clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

#install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# get latest composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#copy .env.example to .env

# generate artisan key

# create system user to run composer and artisan commands
#RUN useradd -G www-data,root -u $uid -d /home/$user $user
#RUN mkdir -p /home/$user/.composer && \
    #chown -R $user:$user /home/$user

#set working directory
WORKDIR /var/www/html