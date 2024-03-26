# Green hub (backend)
<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" >
</p>


<p align="center">
  <img src="https://raw.githubusercontent.com/UgoWadoux/ecom_front/main/src/assets/images/Greeen-Hub-restyle-1.webp"  width="300">  
</p>

## Description

### What is Green hub   ?

Green hub is a company specializing in selling eco-friendly products and services. This project is the back-end part of the e-commerce website.
The backend is an API 

Professional can also provide services through the platform


### What are the technologies used ?

The backend part is develop in Laravel Framework based on php.

### Plugins used :

- sanctum

  
## Installation
### Requirements
For this project you will need :
- Composer (https://getcomposer.org/) to manage php dpendencies
- mysql or an equivalent
- php > 8.0
- Laravel recommand to have NODE and NPM install

### Ready ? Clone the project !
```sh
git clone https://github.com/UgoWadoux/ecom_backend.git
```
### Install composer dependencies
```sh
composer install
```
### Setting up the .env

- Duplicate the .env.example and rename it to .env
- In the .env modify with your database connection
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yourdatabasename
DB_USERNAME=youruser
DB_PASSWORD=yourpassword
```
### Migrate the database 
```sh
php artisan migrate
```
### Seeding the database
```sh
php artisan db:seed
```
### Start the server !
```sh
php artisan run serve
```
## Using the API
### Swagger
A swagger config file can be fond on /storage/api-docs/api-docs.json.

You can consut it on the link : http://127.0.0.1:8000/api/documentation. (Replace  127.0.0.1 with you personnal domain)
### Routes

