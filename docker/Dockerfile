FROM phpdaily/php:7.4.0-dev-cli-buster

RUN apt-get update && \
    apt-get install -y libopencv-videoio-dev libffi-dev wget && \
    rm -rf /var/lib/apt/lists/* &&\
    docker-php-ext-configure ffi --with-ffi && \
    docker-php-ext-install ffi && \
    echo "ffi.enable=1" >> /usr/local/etc/php/php.ini && \
    wget -q -O /usr/local/bin/composer https://getcomposer.org/composer.phar && \
    chmod +x /usr/local/bin/composer

EXPOSE 80

WORKDIR /src

ADD entrypoint /entrypoint

ENTRYPOINT /entrypoint
