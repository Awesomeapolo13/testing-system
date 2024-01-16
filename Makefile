##################
# Variables
##################

DOCKER_COMPOSE = docker compose -f ./.deployment/docker/docker-compose.yml --env-file ./.deployment/docker/.env
DOCKER_COMPOSE_PHP_FPM_EXEC = ${DOCKER_COMPOSE} exec php-fpm

##################
# Docker compose
##################

dc_build:
	${DOCKER_COMPOSE} build

dc_start:
	${DOCKER_COMPOSE} start

dc_stop:
	${DOCKER_COMPOSE} stop

dc_up:
	${DOCKER_COMPOSE} up -d --remove-orphans

dc_up_build:
	${DOCKER_COMPOSE} up -d --build

dc_ps:
	${DOCKER_COMPOSE} ps

dc_logs:
	${DOCKER_COMPOSE} logs -f

dc_down:
	${DOCKER_COMPOSE} down -v --rmi=all --remove-orphans

dc_restart:
	make dc_stop dc_start


##################
# App
##################

app_bash:
	docker exec -it testing-sys-php-fpm bash
com_i:
	docker exec -it testing-sys-php-fpm composer install
test:
	docker exec -it testing-sys-php-fpm php bin/phpunit
cache:
	docker exec -it testing-sys-php-fpm php bin/console cache:clear
m_run:
	docker exec -it testing-sys-php-fpm php bin/console doctrine:migration:migrate
fx_load:
	docker exec -it testing-sys-php-fpm php bin/console doctrine:fixtures:load
init:
	make com_i m_run fx_load
