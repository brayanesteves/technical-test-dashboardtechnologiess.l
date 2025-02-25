.PHONY: setup build up down test db-schema

setup:
	docker-compose build
	docker-compose up -d
	docker-compose exec app composer install
	docker-compose exec app vendor/bin/doctrine orm:schema-tool:update --force

build:
	docker-compose build

up:
	docker-compose up -d

down:
	docker-compose down

test:
	docker-compose exec app vendor/bin/phpunit tests

db-schema:
	docker-compose exec app vendor/bin/doctrine orm:schema-tool:update --force