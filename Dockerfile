# Imagen oficial de PHP con Apache
FROM php:8.2-apache

# Copiar los archivos del proyecto al servidor web
COPY . /var/www/html/

# Dar permisos adecuados
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exponer el puerto
EXPOSE 80

# Iniciar Apache
CMD ["apache2-foreground"]
