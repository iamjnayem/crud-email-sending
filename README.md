# Description About the project

*Student Crud Application where an user can*
1. create student with name, age, department and subjects
2. update student info
3. delete a student
4. download student info into a csv file


# How the application has developed?
1. first of all I created a database schema from given exercise
2. here is the db schema design link: https://drive.google.com/file/d/1dVydWivTbabS9BJQVmXArSOqaMB0vU_B/view?usp=sharing
3. created blade template using bootstrap template
4. used laravel excel to export large csv data on background
5. used mailtrap for sending testing mail

# Which part of code I imphasized?
1. coding structure
2. used repository pattern
3. improved seeding time
4. handled exception

# How to install the application?
1. First clone the project from (https://github.com/iamjnayem/j_nayem_ssl_assessment.git)
2. create .env file
3. give a name to DB_DATABASE in .env file
4. give DB_USERNAME
5. give DB_PASSWORD
6. configure following key

- QUEUE_CONNECTION=database<br>
- MAIL_MAILER=smtp<br>
- MAIL_HOST=smtp.mailtrap.io<br>
- MAIL_PORT=587<br>
- MAIL_USERNAME='your mailtrap user id' <br>
- MAIL_PASSWORD='your mailtrap password'<br>
- MAIL_ENCRYPTION=tls<br>
- MAIL_FROM_ADDRESS='sample@gmail.com'<br>
- MAIL_FROM_NAME="${APP_NAME}"<br>
- APP_URL=http://localhost:8000<br>

7. create a local database with same name
8. type  `composer install` in terminal
9. type  `php artisan key:generate`
9. type  `php artisan migrate` in terminal
7. type `php artisan db:seed` in terminal
8. type `php artisan serve` in terminal


# How I can improve the project?

1. Running queue job automatically
2. handling failed job
3. by configuring max tries.

