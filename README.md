**Setup**
copy .env.example to .env [if not have .env]
configure database

composer install [if not present vendor folder]
php artisan migrate

php artisan serve
npm run dev
php artisan reverb:start --debug
php artisan queue:work

**running docker container**
make sure you have docker setup on your machine

run:
docker compose up

**Testing notification system**
create account
after login or create account you will redirected to home screen where user can subscribe or unsubscribe notification types
user can send notification by pressing send button to subscriber of that type.

user can send real time notification by entering message and select a type.
user that have subscribed that type will receive notification in real time.
