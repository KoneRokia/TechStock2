FROM php:8.3


# Installe Node.js et npm
#RUN apt-get update && apt-get install -y curl gnupg
#RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
#RUN apt-get install nodejs -yl;,,,,

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip unzip

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql gd

COPY . .

#RUN mv .env.prod .env

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

# Installe les dépendances npm
#RUN npm install

# Exécute npm run dev
#RUN npm run build

RUN php artisan cache:clear
RUN php artisan route:cache
RUN php artisan config:cache
RUN php artisan view:clear
#RUN php artisan migrate:refresh --seed
RUN php artisan log-viewer:publish

EXPOSE 80

#VOLUME /var/www/html/public/photo_profile

CMD php artisan serve --host=0.0.0.0 --port=80