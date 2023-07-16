# Tienda Virtual PHP MVC SASS


## Descripción

Este repositorio contiene una Tienda Virtual construida con PHP utilizando el patrón Modelo-Vista-Controlador (MVC) y SASS para el diseño. La aplicación permite a los usuarios administrar productos y realizar ventas en línea. A continuación, se detalla la configuración del proyecto y sus funcionalidades.

## Configuración del Proyecto

- **Nombre**: tienda-virtual-php-mvc-sass
- **Versión**: 1.0.0
- **Licencia**: ISC

## Funcionalidades

Las principales características de la tienda virtual son:

- Gestión de Productos: Los usuarios administradores pueden agregar, editar y eliminar productos de la tienda.
- Carrito de Compras: Los usuarios pueden agregar productos al carrito y realizar una compra.
- Ventas y Reportes: Los usuarios administradores pueden visualizar el resumen de ventas y generar reportes filtrados por mes.
- Diseño Responsivo: La aplicación está diseñada con SASS para garantizar una experiencia atractiva en distintos dispositivos.

## Inicio Rápido

Para ejecutar este proyecto localmente, sigue los siguientes pasos:

1. Clona el repositorio: `git clone <repository_url>`
2. Instala las dependencias: `npm install` (para el frontend) y `composer install` (para el backend)
3. Inicia el servidor de desarrollo: `gulp` (para el frontend) y `php -S localhost:8000 -t public` (para el backend)

## Dependencias

El proyecto utiliza las siguientes dependencias:

- Gulp: Herramienta para automatizar tareas en el frontend
- Browser-sync: Servidor en vivo para desarrollo
- CSSNano: Minifica archivos CSS
- Dart Sass: Preprocesador para SASS
- gulp-autoprefixer: Agrega prefijos de proveedores a CSS
- gulp-cache: Caché de imágenes para acelerar el procesamiento
- gulp-clean: Limpia archivos generados
- gulp-concat: Concatena archivos
- gulp-imagemin: Minifica imágenes
- gulp-notify: Notifica sobre el resultado de las tareas
- gulp-postcss: Procesa CSS utilizando plugins
- gulp-rename: Renombra archivos
- gulp-sass: Compila SASS a CSS
- gulp-sourcemaps: Genera sourcemaps para CSS
- gulp-terser-js: Minifica archivos JavaScript
- gulp-webp: Convierte imágenes a formato WebP
- node-sass: Dependencia para gulp-sass
- sass: Versión de Dart Sass para node
- terser: Minificador de JavaScript

## Uso

Para iniciar el servidor de desarrollo y compilar SASS, ejecuta el siguiente comando:

gulp



Para iniciar el servidor backend de PHP, utiliza:

php -S localhost:8000 -t public



Asegúrate de configurar la conexión a la base de datos en los archivos correspondientes (no proporcionados en este repositorio).



## Licencia

Este proyecto está bajo la Licencia ISC. Siéntete libre de usar, modificar y distribuir el código de acuerdo con los términos de la licencia.