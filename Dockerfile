# Étape 1 : Utiliser une image PHP avec extensions nécessaires
FROM php:8.2-fpm

# Étape 2 : Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Étape 3 : Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Étape 4 : Installer Node.js et npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Étape 5 : Définir le répertoire de travail
WORKDIR /var/www/html

# Étape 6 : Copier uniquement les fichiers nécessaires pour composer install
COPY composer.json composer.lock ./

# Étape 7 : Installer les dépendances PHP
RUN composer install --no-progress --prefer-dist --no-dev --optimize-autoloader

# Étape 8 : Copier le reste du projet
COPY . .

# Étape 9 : Exécuter `composer install` et `php artisan key:generate` au démarrage
CMD ["sh", "-c", "composer install --no-progress --prefer-dist --optimize-autoloader && php artisan key:generate && php-fpm"]
