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

# Étape 6 : Copier tout le projet
COPY . .

# Étape 7 : Vérifier que Laravel est bien copié (DEBUG)
RUN ls -l /var/www/html

# Étape 8 : Installer les dépendances PHP
RUN composer install --no-progress --prefer-dist --optimize-autoloader

# Étape 9 : Exposer le port
EXPOSE 9000

# Étape 10 : Lancer PHP-FPM avec un message de débogage
CMD ["sh", "-c", "echo 'Démarrage de PHP-FPM...' && php-fpm"]
