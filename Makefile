up-app:
	cp .env.example .env
	docker compose up -d
	docker compose exec -it php bin/console doctrine:migrations:migrate

up-database:
	docker compose up -d database
