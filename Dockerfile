FROM php:8.1-apache

# Copiar los archivos desde la carpeta principales al directorio raíz web de Apache
COPY principales/ /var/www/html/

# Dar permisos adecuados al usuario www-data
RUN chown -R www-data:www-data /var/www/html

# Configurar Apache para que busque primero index.html, luego index.php y luego main.php
RUN echo "DirectoryIndex index.html index.php main.php" >> /etc/apache2/apache2.conf

# Cambiar el puerto de escucha de Apache a 8080, que es el que usa Render
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Exponer el puerto 8080
EXPOSE 8080

# Ejecutar Apache en primer plano
CMD ["apache2-foreground"]
