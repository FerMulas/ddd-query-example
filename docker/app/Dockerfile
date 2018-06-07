FROM docker_php:latest

WORKDIR /var/www

ARG UNAME
RUN useradd -m -g staff -s /bin/bash $UNAME
RUN mkdir -p /var/www/html/spotahome-exercise
RUN chown -R $UNAME:staff /var/www/html/spotahome-exercise
RUN chmod 775 -R /var/www/html/spotahome-exercise

USER $UNAME
COPY ./Common /var/www/html/spotahome-exercise/Common
COPY ./Apartments /var/www/html/spotahome-exercise/Apartments
COPY ./composer.phar /var/www/html/spotahome-exercise/composer.phar
COPY ./composer.json /var/www/html/spotahome-exercise/composer.json

EXPOSE 9000