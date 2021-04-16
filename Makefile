init: docker-down-clear \
	docker-pull docker-build docker-up \
	cli-init test-init

up: docker-up
down: docker-down
restart: down up

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build --pull

cli-init: cli-permissions cli-composer-install cli-wait-db cli-migrations

cli-permissions:
	docker run --rm -v ${PWD}:/app -w /app $(shell basename $(CURDIR))_php-cli chmod 777 runtime web/assets yii tests/bin/yii

cli-composer-install:
	docker-compose run --rm php-cli composer install

cli-composer-update:
	docker-compose run --rm php-cli composer update

cli-wait-db:
	docker-compose run --rm php-cli wait-for-it postgres:5432 -t 30

cli-migrations:
	docker-compose run --rm php-cli ./yii migrate --interactive=0

cli-create-admin:
	docker-compose run --rm php-cli ./yii user/create-admin

test-init: test-wait-db test-migrations run-tests

test-wait-db:
	docker-compose run --rm php-cli wait-for-it postgres-test:5432 -t 30

test-migrations:
	docker-compose run --rm php-cli ./tests/bin/yii migrate --interactive=0

run-tests:
	docker-compose run --rm php-cli ./vendor/bin/codecept run unit

