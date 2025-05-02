FROM debian:12-slim

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get install -y \
      curl \
    && rm -rf /tmp/* /var/tmp/*

RUN curl -sSLo sury.sh https://packages.sury.org/php/README.txt \
  && chmod +x sury.sh \
  && sh sury.sh \
  && apt-get install --no-install-recommends and --no-install-suggests -y \
      php7.4-fpm \
      php7.4-xdebug \
      php7.4-pgsql \
  && apt-get clean  \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY dev.ini  /etc/php/7.4/mods-available/dev.ini

run phpenmod dev

RUN groupadd --gid 1000 ixcsoft && \
    useradd --uid 1000 --gid ixcsoft --shell /bin/bash --create-home ixcsoft


WORKDIR /opt/project


RUN sed -i 's|/run/php/php7.4-fpm.sock|0.0.0.0:9000|' /etc/php/7.4/fpm/pool.d/www.conf
EXPOSE 9000

CMD ["/usr/sbin/php-fpm7.4", "-F"]