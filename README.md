# Installation Process

1. First clone the project from (https://github.com/iamjnayem/j_nayem_ssl_assessment.git)
2. create .env file
3. give a name to DB_DATABASE in .env file
4. give DB_USERNAME
5. give DB_PASSWORD
4. create a local database with same name
5. type  `composer install` in terminal
6. type `php artisan migrate ` in terminal
7. type `php artisan db:seed` in terminal
8. type `php artisan serve` in terminal


# How I can improve the project?

1. using validation
2. using exception handling
3. using DB::transaction where several operations happend
4. using flash message
5. some routes needs to complete.
6. using repository pattern for crud for sepration business logic
7. Adding Queue Job to download. though laravel excel use similar process

