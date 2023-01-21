# Laravel test case
Test task from https://gist.github.com/smskin/aa39833f9d57f9e96899c8b065057eb7

Using Laradock, Vue 2, Laravel 8

Done only what is required in the test task. There are some things that I would also implement

# Roadmap:
    1) Authorization
    2) Create and edit article
    3) Make Rest API
    4) Add tests

# How to work
Project must be near laradock folder

1) composer install
2) npm install
3) php artisan key:generate
4) php artisan migrate
5) php artisan db:seed

To live change likes
`php artisan queue:listen`

To add comments in the background
`php artisan queue:work --queue="add-comment"`