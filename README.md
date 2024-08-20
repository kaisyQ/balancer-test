# Balancer mircoservice

This project uses the **Symfony 7** framework, **PHP 8.3**, and **PostgreSQL** as the database management system.

## Local Development

To set up the project locally, follow these steps:

### With Make

If you have Make installed, you can use the following command to set up the project:

``make up-app``

Or, if you're on Linux and Docker requires sudo privileges:

``sudo make up-app``
### Without Make

If you don't have Make installed, you can use the following commands to set up the project:

## 
``cp .env.example .env``

``docker compose up -d``

``docker compose exec -it app php bin/console doctrine:migrations:migrate``

Note: If you're on Linux and Docker requires sudo privileges, add `sudo` before each Docker command.

## OpenAPI Documentation

The OpenAPI documentation for this project is available at the following routes:

* `/api/doc` (Redoc format)
* `/api/doc.json` (JSON format)