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

# Étape 6 : Copier les fichiers du projet
COPY . .

# Étape 7 : Installer les dépendances PHP et Node.js
RUN composer install --no-progress --prefer-dist --optimize-autoloader
RUN npm install && npm run build

# Étape 8 : Exposer le port
EXPOSE 9000

# Étape 9 : Lancer PHP-FPM au démarrage du conteneur
CMD ["php-fpm"]
