<h1>HOW TO RUN THIS PROJECT</h1>
<br>
<h2>Run this command at Terminal</h2>

- Install Composer
  ```sh
  composer install

- Setting .env 
  ```sh
  cp .env.example .env
  
- Mengubah DB_DATABASE pada file .env sesuai dengan nama database

- Generate Key
  ```sh
  php artisan key:generate

- Migration
  ```sh
  php artisan migrate

- Seeder
  ```sh
  php artisan db:seed
  
- Run Project
  ```sh
  php artisan serve

