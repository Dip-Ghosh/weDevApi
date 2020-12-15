# weDevApi
Instructions for Run the Project

1. First clone the project
2. composer install
3. cp .env.example .env
4. php artisan key:generate
5. php artisan jwt:secret
6. php -S localhost:8000 -t public
7. set up the database and other things in env
8. php artisan migrate
9. php -S localhost:8000 -t public