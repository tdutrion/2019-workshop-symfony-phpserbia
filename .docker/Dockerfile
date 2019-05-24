FROM php:7.3-apache

RUN apt-get update \
    && apt-get install --no-install-recommends --assume-yes --quiet ca-certificates curl libpq-dev git \
       libicu-dev libpng-dev libjpeg-dev libzip-dev zip unzip \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install intl pdo pdo_mysql gd zip \
    && docker-php-ext-configure gd --with-jpeg-dir=/usr/include \
    && curl -Lsf 'https://storage.googleapis.com/golang/go1.8.3.linux-amd64.tar.gz' | tar -C '/usr/local' -xvzf - \
    && apt-get clean && rm -rf /var/lib/apt/lists/* \
    && a2enmod rewrite \
    && curl --silent --show-error https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

ENV PATH /usr/local/go/bin:$PATH

RUN go get github.com/mailhog/mhsendmail \
 && cp /root/go/bin/mhsendmail /usr/bin/mhsendmail \
 && echo 'sendmail_path = /usr/bin/mhsendmail --smtp-addr mailhog:1025' > /usr/local/etc/php/php.ini

WORKDIR /var/www/symfony
