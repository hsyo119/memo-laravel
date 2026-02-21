# Composer stage
FROM composer:2 AS composer

# PHP stage
FROM php:7.4-fpm

COPY php.ini /usr/local/etc/php/

# Packages
RUN apt-get update \
  && apt-get install -y --no-install-recommends \
    vim \
    curl \
    ca-certificates \
    gnupg \
    zlib1g-dev \
    git \
    libzip-dev \
    libonig-dev \
    libc-client-dev \
    libkrb5-dev \
  && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN PHP_OPENSSL=yes docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
  && docker-php-ext-install -j$(nproc) zip pdo_mysql mysqli mbstring imap

# Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Node.js 20.x
RUN set -eux; \
  mkdir -p /etc/apt/keyrings; \
  curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key \
    | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg; \
  echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_20.x nodistro main" \
    > /etc/apt/sources.list.d/nodesource.list; \
  apt-get update; \
  apt-get install -y --no-install-recommends nodejs; \
  rm -rf /var/lib/apt/lists/*; \
  node -v; \
  npm -v