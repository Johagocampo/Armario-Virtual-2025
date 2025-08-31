FROM php:8.1-apache

# Copiar todo el proyecto
COPY . /var/www/html/

# Dar permisos
RUN chown -R www-data:www-data /var/www/html

# Hacer que Apache use main.php si no hay index.php
RUN echo "DirectoryIndex main.php" >> /etc/apache2/apache2.conf

# Usar puerto 8080 para Render
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 8080

CMD ["apache2-foreground"]
