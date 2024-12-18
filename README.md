# Invoice-Management-System
 LoadServ company task

```shell
# dont forget to install and npm install
composer install
npm install
# copy .env.example to .env
cp .env.example .env
# add a database name
cp DB_DATABASE=LoadServ_Task
# generate security key 
php artisan key:generate
# after connect your database via .env file
php artisan migrate:fresh
php artisan db:seed
# run there comment to run project
php artisan serve
php artisan queue:work
npm run dev
```
---


```shell 
# Admin
	email: admin@admin.com
	password: 123456789
	url: http://127.0.0.1:8000/login

# Employee
	email: employee@employee.com
	password: 123456789
	url: http://127.0.0.1:8000/login
```
---