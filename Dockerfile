FROM php:7.4-apache

# Aktualizacja pakietów i instalacja zależności
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install mysqli pdo_mysql zip

# Włączenie mod_rewrite dla Apache
RUN a2enmod rewrite

# Konfiguracja DocumentRoot dla Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public_html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Kopiowanie kodu aplikacji
COPY . /var/www/html

# Ustawienie zmiennej środowiskowej dla Dockera
ENV DOCKER_ENV=true

# Zmiana właściciela plików na www-data (użytkownik Apache)
RUN chown -R www-data:www-data /var/www/html

# Ustawienie portu
EXPOSE 80

# Uruchomienie Apache w tle
CMD ["apache2-foreground"] 