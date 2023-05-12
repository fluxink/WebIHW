FROM php:8.2.5-apache
RUN docker-php-ext-install mysqli
COPY . /var/www/html/
WORKDIR /var/www/html/
EXPOSE 80