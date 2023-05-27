up:
	docker compose -f docker/docker-compose.yml up -d --force-recreate

down:
	docker compose -f docker/docker-compose.yml down

restart:
	make down
	make up

app-up:
	docker compose -f docker/docker-compose.yml up app -d --force-recreate

app-down:
	docker compose -f docker/docker-compose.yml stop app

app-restart:
	make app-down
	make app-up

app-build:
	docker compose -f docker/docker-compose.yml build app --no-cache

app-logs:
	docker compose -f docker/docker-compose.yml logs -f app

app-bash:
	docker compose -f docker/docker-compose.yml exec app bash

app-composer-install:
	docker compose -f docker/docker-compose.yml exec app composer install

app-migrate-fresh:
	docker compose -f docker/docker-compose.yml exec app php artisan migrate:fresh --seed

webgrind-up:
	docker run -d --name webgrind -p 8001:80 -v docker_static-content:/tmp jokkedk/webgrind:latest

webgrind-down:
	docker stop webgrind
	docker rm webgrind

webgrind-restart:
	make webgrind-down
	make webgrind-up