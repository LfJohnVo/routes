Una vez descargado se deben correr los siguientes comandos en este orden:

 1. composer install
 2. cp .env.example .env
 3. php artisan key:generate
 4. php artisan migrate --seed
