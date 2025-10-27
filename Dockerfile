FROM php:8.2-cli

WORKDIR /app

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer de manera confiable
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar archivos de Composer e instalar dependencias
COPY composer.json composer.lock* ./
RUN composer install --no-scripts --no-interaction --prefer-dist

# Copiar el resto del proyecto
COPY . .

CMD ["php", "-a"]
