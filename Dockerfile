FROM php:8.0.5-fpm-alpine

RUN apk update
RUN apk add --no-cache \
		$PHPIZE_DEPS \
		openssl-dev

RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install bcmath
RUN yes | pecl install pecl_http

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apk add \nmap \vim