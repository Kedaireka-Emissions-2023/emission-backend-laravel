FROM php:8.1-fpm-alpine

RUN apk add --no-cache nginx wget \
    && docker-php-ext-install pdo pdo_mysql

RUN mkdir -p /run/nginx

COPY docker/nginx.conf /etc/nginx/nginx.conf

RUN mkdir -p /app
COPY . /app
COPY ./src /app

RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
RUN cd /app && \
    /usr/local/bin/composer update

RUN cd /app && \
    php artisan route:cache

RUN chown -R www-data: /app

CMD sh /app/docker/startup.sh
