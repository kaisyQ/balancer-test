up-app:
	cp .env.example .env
	docker compose up --d
	php bin/console doctrine:migrations:migrate