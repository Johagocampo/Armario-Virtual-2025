FROM php:8.1-apache

# Copiar los archivos PHP desde /principales al directorio web de Apache
COPY principales/ /var/www/html/

# Dar permisos adecuados
RUN chown -R www-data:www-data /var/www/html

# Cambiar el archivo de inicio si usas main.php
RUN echo "DirectoryIndex main.html" >> /etc/apache2/apache2.conf

# Cambiar Apache para que escuche en el puerto 8080 (Render lo requiere)
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Exponer el puerto que Render espera
EXPOSE 8080

# Iniciar Apache
CMD ["apache2-foreground"]
