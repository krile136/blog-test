start:
	mkdir ./docker/nginx/logs
	mkdir ./docker/mysq
	cp .env.example .env
	docker exec blog-app php artisan key:generate 
	docker exec blog-app chown -R root:root .
	docker exec blog-app npm run build
	docker exec blog-app chmod -R guo+w storage
	docker exec blog-app php artisan storage:link

up:
	docker compose up -d
	docker exec blog-app composer install
	docker exec blog-app npm install

down:
	docker compose down

restart:
	docker compose down
	docker compose up -d
	docker exec blog-app composer install
	docker exec blog-app npm install

web:
	docker exec -it blog-app /bin/bash

build:
	docker exec blog-app npm run build

sudo-up:
	sudo docker compose up -d
	sudo docker exec blog-app composer install
	sudo docker exec blog-app npm install

sudo-down:
	sudo docker compose down

sudo-restart:
	sudo docker compose down
	sudo docker compose up -d
	sudo docker exec blog-app composer install
	sudo docker exec blog-app npm install

sudo-web:
	sudo docker exec -it blog-app /bin/bash

sudo-build:
	sudo docker exec blog-app npm run build
