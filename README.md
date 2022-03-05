# Classera System Integration 1

## Installation 

- Clone Project
```shell
git clone git@github.com:ahmad-marzouq/classera_system1.git
cd classera_system1
```
- Run Composer Install
```shell
composer install
```
- Run Npm Install
```shell
npm install
npm run dev
```

- Fill ``.env`` file config 
```dotenv
DB_DATABASE=<db_name>
DB_USERNAME=<db_user>
DB_PASSWORD=<db_password>

SYSTEM2_HOST=<system2_host>
SYSTEM2_CLIENT_ID="" #Using php artisan pasport:client --client in system2
SYSTEM2_CLIENT_SECRET=""
SYSTEM2_SSO_CLIENT_ID=""#Using php artisan passport:client --name="SSO Login" --public in system2
```

- Run Migrations
```shell
php artisan migrate
```
- You can create a new user using the `/register` route
