## CRUD App Backend (CodeIgniter 4 , MySql )

## Project setup
```
composer install

```

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

```
cp env .env

```

## Run follwing commnds for Migration and database seeding
```
php spark migrate
```
```
php spark db:seed StatusSeeder
```
## This is Optional (It will add defalut 10 Records to database )

```
php spark db:seed TruckSeeder

```

## Postman Collection URL
https://documenter.getpostman.com/view/4752784/TWDdjZAX
