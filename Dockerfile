FROM php:8.1-fpm-alpine

RUN apk update && apk add \
    curl \
    nginx \
    supervisor \
    && docker-php-ext-install pdo pdo_mysql

COPY zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf
COPY default.conf /etc/nginx/http.d/default.conf
COPY nginx.conf /etc/nginx/nginx.conf

RUN mkdir -p /var/run/php && \
    chown nginx:nginx /var/run/php

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /app

COPY . .
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN composer install

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
