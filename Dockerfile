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
COPY 000-default.conf /etc/apache2/sites-available/
RUN a2ensite 000-default.conf

WORKDIR /var/www/html
EXPOSE 80