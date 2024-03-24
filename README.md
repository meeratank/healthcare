# Healthcare Appointment Booking API
Develop a RESTful API using PHP and Laravel that allows users to book, view, and cancel healthcare appointments. The API should interact with a MySQL database to store and retrieve data.

## Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/10.x/installation)


Clone the repository

    git clone https://github.com/meeratank/healthcare.git

Switch to the repo folder

    cd healthcare

Install all the dependencies using composer

    composer install

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**Populate the database with seed data which includes users & professionals. This can help you to quickly start testing the api with ready content.**

Run the database seeder and you're done

    php artisan db:seed
    
## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------


# Testing API

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://localhost:8000/api

Request headers

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| Yes      	| Accept     	| application/json 	|
| Optional 	| Authorization    	| Bearer {token}      	|

#### User registration

```http

  POST /api/register
```

| Parameter | Type     | 
| :-------- | :------- | 
| `name` | `string` |
| `email` | `string` |
| `password` | `string` |
| `password_confirmation` | `string` | 

#### User login

```http

  POST /api/login
```

| Parameter | Type     | 
| :-------- | :------- | 
| `email` | `string` |
| `password` | `string` |


#### List Professionals

```http

  GET /api/professionals
```
#### Book Appointment

```http

  POST /api/appointment/store
```

| Parameter | Type     | 
| :-------- | :------- | 
| `healthcare_professional_id` | `int` |
| `appointment_start_time` | `Y-m-d H:i:s` |
| `appointment_end_time` | `Y-m-d H:i:s` |

#### List User Appointment

```http

  GET /api/appointment/
```

#### Change User Appointment
status = completed | cancelled
```http

  GET /api/appointment/{appointment}/{status}


