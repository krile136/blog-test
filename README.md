## git cloneしたあと

$ mkdir ./docker/nginx/logs
$ mkdir ./docker/mysql
$ cp .env.example .env
$ docker exec blog-app php artisan key:generate 
$ docker exec blog-app chown -R root:root .
$ docker exec blog-app npm run build
$ docker exec blog-app chmod -R guo+w storage
$ docker exec blog-app php artisan storage:link

