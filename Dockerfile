FROM php:7.2.5-fpm
# set work directory
WORKDIR /usr/src/app

# copy project
COPY . /usr/src/app/

# install dependencies
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
RUN apt-get update && apt-get install -y \
                 git   \
                 zip \
                 unzip
ENTRYPOINT ["sh", "/usr/src/app/run.sh"]
