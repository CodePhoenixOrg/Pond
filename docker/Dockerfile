FROM php:7.4-apache

# Avoid warnings by switching to noninteractive
ENV DEBIAN_FRONTEND=noninteractive

# This Dockerfile adds a non-root user with sudo access. Use the "remoteUser"
# property in devcontainer.json to use it. On Linux, the container user's GID/UIDs
# will be updated to match your local UID/GID (when using the dockerFile property).
# See https://aka.ms/vscode-remote/containers/non-root-user for details.
ARG USERNAME=vscode
ARG USER_UID=1000
ARG USER_GID=$USER_UID

# Configure apt and install packages
RUN apt-get update && apt-get -y upgrade \
    && apt-get -y install --no-install-recommends apt-utils dialog 2>&1 \
    && apt-get -y install git openssh-client less iproute2 procps iproute2 lsb-release zip unzip \
    && yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && docker-php-ext-enable xdebug \
    # Create a non-root user to use if preferred - see https://aka.ms/vscode-remote/containers/non-root-user.
    && groupadd --gid $USER_GID $USERNAME \
    && useradd -s /bin/bash --uid $USER_UID --gid $USER_GID -m $USERNAME \
    # [Optional] Add sudo support for the non-root user
    && apt-get install -y sudo \
    && echo $USERNAME ALL=\(root\) NOPASSWD:ALL > /etc/sudoers.d/$USERNAME\
    && chmod 0440 /etc/sudoers.d/$USERNAME \
    #
    # Clean up
    && apt-get autoremove -y \
    && apt-get clean -y \
    && rm -rf /var/lib/apt/lists/*
COPY bin/hop /usr/local/bin/hop
COPY certs /certs
RUN unzip /certs/rootCA.zip -d /certs && unzip /certs/pond.loc.zip -d /certs 
COPY apache/pond.conf apache/ssl-pond.conf /etc/apache2/sites-available/
COPY php/php.ini /usr/local/etc/php/php.ini
COPY php/xdebug-settings.ini /usr/local/etc/php/conf.d/xdebug-settings.ini
RUN cat /usr/local/etc/php/conf.d/xdebug-settings.ini >> /usr/local/etc/php/conf.d/xdebug.ini && rm /usr/local/etc/php/conf.d/xdebug-settings.ini
RUN a2enmod rewrite && a2enmod ssl && a2ensite ssl-pond

# Switch back to dialog for any ad-hoc use of apt-get
ENV DEBIAN_FRONTEND=dialog

#ENV PORT 80
ENTRYPOINT []
#CMD sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf && docker-php-entrypoint apache2-foreground
CMD docker-php-entrypoint apache2-foreground
