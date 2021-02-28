FROM php:7.4-fpm-alpine

RUN apk update \
    && apk add --no-cache composer make autoconf g++ \
    && docker-php-ext-install pdo_mysql \
    && apk del --purge autoconf g++ make



