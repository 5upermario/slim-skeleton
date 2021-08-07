FROM ubuntu:20.04

WORKDIR /var/www/html

RUN apt-get update && apt-get upgrade -y && apt-get install -y tzdata && dpkg-reconfigure -f noninteractive tzdata

RUN apt-get install -y php php-curl php-common php-cli php-mysql php-pear php-dev php-mbstring php-sqlite3 git

RUN pear channel-update pear.php.net
RUN pecl channel-update pecl.php.net

RUN pecl install mongodb
RUN echo "extension=mongodb.so" >> /etc/php/7.4/cli/php.ini

RUN pecl install xdebug
RUN echo "zend_extension=xdebug.so" >> /etc/php/7.4/cli/php.ini

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php && php -r "unlink('composer-setup.php');" && mv composer.phar /usr/local/bin/composer

RUN pecl clear-cache && apt-get clean

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
