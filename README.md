# Проект

## Установка и настройка

### 1. Клонировать проект
Для начала необходимо склонировать репозиторий:

```bash
git clone <URL-репозитория>
cd <папка-проекта>
```

## 2. Настройка .env

Скопируйте файл `.env.example` и переименуйте его в `.env`:

```bash
cp .env.example .env
```

Настройте подключение к базе данных в файле `.env`:
```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=myNews
DB_USERNAME=app_user
DB_PASSWORD=app_password
```

Можете использовать `Docker` для конфигурации, запустив:
```bash
docker-compose up -d
```

## 3. Установка зависимостей
Запустите следующие команды для установки зависимостей и настройки проекта:

```bash
composer install
php artisan key:generate
php artisan storage:link
php artisan migrate
php artisan db:seed
```

##4. Запуск проекта
Для запуска проекта используйте команду:
```bash
php artisan serve
```
Сайт будет доступен по адресу http://localhost:8000 по умолчанию или по адресу, который будет выведен в консоли после запуска команды `php artisan serve`.

