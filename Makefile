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
