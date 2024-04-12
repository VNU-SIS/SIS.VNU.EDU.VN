cp .env.example .env

docker-compose build

docker-compose up -d

docker-compose exec laravel bash

composer install

php artisan key:generate

php artisan ckfinder:download

php artisan vendor:publish --tag=ckfinder-assets --tag=ckfinder-config

mkdir -m 777 public/userfiles

sudo chmod 777 -R public/userfiles/

php artisan storage:link

npm install

npm run dev

# DB

http://localhost/adminer.php

server: mysql
user: root
pass: root
