FROM php:7.4-fpm-alpine

RUN apk update \
    && apk add --no-cache composer make autoconf g++ \
    && apk del --purge autoconf g++ make



