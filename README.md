
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


