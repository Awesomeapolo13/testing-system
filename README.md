# Система тестирования с поддержкой нечеткой логики

## Описание

Тестовая система, поддерживающая вопросы с нечеткой логикой.

В данной системе ответ считается верным,
если содержит хотя бы один правильный ответ
и не содержит ни одного неправильного ответа.

Стек:
- php-8.2;
- docker v24.0.7;
- docker compose v2.18.1;
- Symfony framework v6.3;
- Doctrine ORM 2.16;

## Деплой локально

1) Скопировать файл `.deployment/docker/.env.dist` в ту же директорию,
предварительно удалив окончание `.dist`
2) Заполнить ключи получившегося файла `.env` нужной информацией. Можно взять пример ниже:

```dotenv
COMPOSE_PROJECT_NAME=testing-sys

PUID=1000
PGID=1000

#nginx
NGINX_HOST_HTTP_PORT=888
INSTALL_XDEBUG=true
#postgress
POSTGRES_DB=testing-sys-db
POSTGRES_PORT=5432
POSTGRES_USER=apps
POSTGRES_PASSWORD=apps
```

3) Проделайте аналогичную операцию с `.env.dist` в корне проекта. Пример ниже.

```dotenv
###> symfony/framework-bundle ###
APP_ENV=dev
APP_SECRET=40c23bc14d40a043338fad7942ff2770
###< symfony/framework-bundle ###

###> doctrine/doctrine-bundle ###
DATABASE_URL="postgresql://apps:apps@testing-sys-db:5432/testing-sys-db?serverVersion=16&charset=utf8"
###< doctrine/doctrine-bundle ###
```

Убедитесь что данные в `DATABASE_URL` файлв `.env`
соответствуют данным подключения к БД в `.deployment/docker/.env`

4) После заполнения данных `.env` файлов выполните команду ниже:

```shell
make dc_up_build
```

5) После того как окружение развернуто выполните команду:

```shell
make init
```

Далее произойдет установка необходимых зависимостей composer, выполнение миграций 
и генерация фейковых данных для тестирования.

При выполнении миграций и загрузке фикстур выбрать `yes`.

6) Перейти на страницу `localhost:NGINX_HOST_HTTP_PORT`. 
На ней будет выведен список тестов доступных для прохождения.
7) Далее можно попробовать пройти пробный тест и сравнить результат с требованиями тестового задания.
