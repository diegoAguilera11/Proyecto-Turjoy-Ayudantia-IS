# Proyecto Melody Ayudantía Ingeniería de Software 2023-2
Bienvenid@s al código desarrollado en las ayudantías de Ingeniería de Software correspondientes al proyecto de la asignatura.

## IMPORTANTE
Debe tener previamente instalado composer y PHP >= 8.1.12 v para evitar futuros errores u problemas, una vez haya clonado el proyecto.

## Instalación

Ejecuta el siguiente comando para poder instalar composer en el proyecto.
```bash
composer install
```
Debemos copiar el archivo .env para poder establecer la conexión con nuestra base de datos.
```bash
copy .env.example .env
```
Este comando establecera la APP_KEY en nuestro archivo .env
```bash
php artisan key:generate
```
Cambiamos los siguientes parámetros:
```bash
DB_PORT = Depende del puerto asigando por usted en la configuración de su base de datos(default: 3306)
DB_DATABASE = Aqui va el nombre de la base de datos creada en nuestro administrador de base de datos preferido.
DB_USERNAME = root
DB_PASSWORD = Es la contraseña que nosotros asignamos en la instalación, en caso de utilizar Xampp, Laragon, etc.. Este campo se debe dejar vacio.
```
Este comando ejecutara las migraciones del proyecto y una vez creada las tablas en la base de datos, dara paso a ejecutar los seeders que forman parte del estado predeterminado del sistema.
```bash
php artisan migrate --seed
```
En caso de que no funcione la migración, actualize el archivo .env con los siguientes comandos.
```bash
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```
Ahora procederemos a ejecutar el Sistema Web con los siguientes comandos:
```bash
php artisan serve
```
Para ejecutar los estilos de TailwindCSS
```bash
npm run dev
```
## Realizado por Diego Aguilera Ayudante de Ingeniería de Software UCN
