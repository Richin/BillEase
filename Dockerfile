
FROM php:8.3.8-apache
RUN a2enmod rewrite
# Install dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    libcurl4-openssl-dev

# Install extensions
RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install curl





WORKDIR /var/www/html
EXPOSE 80