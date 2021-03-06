FROM php:7.4-apache
RUN a2enmod rewrite
RUN a2enmod ssl
RUN apt-get -y update && apt-get -y upgrade && apt-get -y autoremove && apt-get -y install zip unzip
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && docker-php-ext-enable xdebug  
COPY certs /certs
RUN unzip /certs/rootCA.zip -d /certs && unzip /certs/pond.loc.zip -d /certs 
COPY apache/pond.conf apache/ssl-pond.conf /etc/apache2/sites-available/
COPY php/php.ini /usr/local/etc/php/php.ini
COPY php/xdebug-settings.ini /usr/local/etc/php/conf.d/xdebug-settings.ini
RUN cat /usr/local/etc/php/conf.d/xdebug-settings.ini >> /usr/local/etc/php/conf.d/xdebug.ini && rm /usr/local/etc/php/conf.d/xdebug-settings.ini
RUN a2ensite ssl-pond
#ENV PORT 80
ENTRYPOINT []
#CMD sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf && docker-php-entrypoint apache2-foreground
CMD docker-php-entrypoint apache2-foreground
