## PENJADWALAN RUANG KULIAH V 1.0


## Instalasi

-   download zip <a href="https://github.com/mahdiawan-nk/aplikasi-penjadawalan-kuliah/archive/refs/heads/main.zip">disini</a>
-   atau clone : git clone https://github.com/mahdiawan-nk/aplikasi-penjadawalan-kuliah.git

## Setup

-   buka direktori project di terminal anda.
-   ketikan command : cp .env.example .env (copy paste file .env.example)
-   buat database

Lalu ketik command dibawah ini

-   composer install
-   php artisan optimize:clear
-   php artisan key:generate (generate app key)
-   php artisan migrate (migrasi database)
-   php artisan db:seed
-   php artisan storage:link
-   php artisan serve

## Login

-   Email : operator
-   Password : 12345678

