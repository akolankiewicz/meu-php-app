FROM debian:12-slim

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get install -y  \
      curl \
    && rm -rf /tmp/* /var/tmp/*

RUN curl -sSLo sury.sh https://packages.sury.org/php/README.txt \
  && chmod +x sury.sh \
  && sh sury.sh \
  && apt-get install --no-install-recommends and --no-install-suggests -y \
      php7.4-cli \
      php7.4-xdebug \
      php7.4-pgsql \
  && apt-get clean  \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

COPY dev.ini  /etc/php/7.4/mods-available/dev.ini

RUN phpenmod dev

WORKDIR /opt/project

RUN groupadd --gid 1000 ixcsoft && \
    useradd --uid 1000 --gid ixcsoft --shell /bin/bash --create-home ixcsoft



USER ixcsoft


#FROM debian:12-slim
#
#ENV DEBIAN_FRONTEND=noninteractive
#
#RUN apt-get update \
#    && apt-get install --no-install-recomends --no-install-suggests -y \
#     curl \
#    && rm -rf /tmp/* /var/tmp/*
#
#RUN curl -sL -o sury.sh https://packages.sury.org/php/README.txt \
#    && chmod +x sury.sh \
#    && sh sury.sh \
#    && apt-get install -y \
#      php7.4 \
#    && rm -rf /tmp /var/lib/apt/lists/*
#
#RUN apt-get install -y \
#    php7.4 \
#    php7.4-74-cli \
#    php7.4-pdo \
#    php7.4-pdo-mysql
#
#COPY --from=composer/composer:latest-bin /composer /usr/bin/composer
#
#WORKDIR /opt/project
#
#RUN groupadd --gid 1000 ixcsoft && \
#    useradd --uid 1000 --gid ixcsoft --shell /bin/bash --create-home ixcsoft
#
#USER ixcsoft
#
#COPY ../../../index.php /opt/project/index.php
#
#ENTRYPOINT ["php", "index.php"]

