FROM php:8.1-apache

# Copiar archivos del proyecto
COPY . /var/www/html/

# Dar permisos correctos
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto que Render necesita
EXPOSE 8080

# Apache en modo "foreground" escuchando en el puerto 8080
CMD ["apache2-foreground", "-DFOREGROUND"]
