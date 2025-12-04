---

marp: true
size: 4:3
paginate: true
title: Project 2 – Laravel REST API
-----------------------------------

# Project 2 — Laravel API

## Secure REST API with Laravel + Sanctum + MySQL

* Token authentication (Laravel Sanctum)
* Docker environment
* Marp slides + cURL tests
* Expands on Project 1 foundations

---

# Slide 1 — Overview

* API endpoints built with Laravel
* Sanctum authentication
* CRUD for Users
* Docker & Composer setup

---

# Slide 2 — Requirements Mapping

* ≥ 8 REST API endpoints
* Sanctum-protected routes
* MySQL migrations & models
* cURL + Postman tests
* Marp slide deck

---

# Slide 3 — API Design (routes/api.php)

* POST /register
* POST /login
* GET /profile *(auth)*
* GET /users *(auth)*
* GET /users/{id} *(auth)*
* POST /users *(auth)*
* PUT /users/{id} *(auth)*
* DELETE /users/{id} *(auth)*

---

# Slide 4 — Database Schema (migration)

```php
Schema::create('users', function (Blueprint $table) {
  $table->id();
  $table->string('name');
  $table->string('email')->unique();
  $table->string('password');
  $table->timestamps();
});

Schema::create('roles', function (Blueprint $table) {
  $table->id();
  $table->string('role');
  $table->timestamps();
});
```

---

# Slide 5 — Docker Setup

* `docker-compose.yml` includes PHP, MySQL, NGINX
* Build: `docker-compose build`
* Start: `docker-compose up -d`
* Shell: `docker exec -it laravel-app sh`

---

# Slide 6 — Register

**Request**

```
POST /api/register
{"name":"Alice","email":"alice@example.com","password":"secret"}
```

**Response**

```
{"message":"registered","user":{...}}
```

---

# Slide 7 — Login

**Request**

```
POST /api/login
{"email":"alice@example.com","password":"secret"}
```

**Response**

```
{"token":"<SANCTUM_TOKEN>"}
```

---

# Slide 8 — Using the Token

Add header:

```
Authorization: Bearer <token>
```

Laravel validates via Sanctum middleware.

---

# Slide 9 — Get Users

**Request**

```
GET /api/users
Authorization: Bearer <token>
```

**Response**

```
[{"id":1,"name":"Alice", ... }]
```

---

# Slide 10 — Create User

**Request**

```
POST /api/users
{"name":"Bob","email":"bob@example.com","password":"pass"}
```

**Response**

```
{"message":"created","user":{...}}
```

---

# Slide 11 — Update User

**Request**

```
PUT /api/users/2
{"name":"Bob Updated"}
```

**Response**

```
{"message":"updated"}
```

---

# Slide 12 — Delete User

**Request**

```
DELETE /api/users/2
```

**Response**

```
{"message":"deleted"}
```

---

# Slide 13 — Profile

**Request**

```
GET /api/profile
```

**Response**

```
{"id":1,"name":"Alice","email":"alice@example.com"}
```

---

# Slide 14 — Controllers

AuthController:

* register()
* login()

UserController:

* index(), show(), store(), update(), destroy(), profile()

---

# Slide 15 — Models

* **User.php** — Has API token capabilities
* **Role.php** — Optional role assignment

---

# Slide 16 — Password Hashing

Laravel handles hashing with:

```
Hash::make($password)
```

Never store raw passwords.

---

# Slide 17 — Test UI

* Use Postman / Thunder Client
* Use example HTML+Fetch page (optional)

---

# Slide 18 — cURL Tests

Examples:

```
curl -X POST http://localhost/api/login \
 -H "Content-Type: application/json" \
 -d '{"email":"alice@example.com","password":"secret"}'
```

---

# Slide 19 — Deployment

Options:

* Docker
* NGINX + PHP-FPM
* Laravel config optimization: `php artisan optimize`

---

# Slide 20 — NGINX Config

```nginx
server {
  listen 80;
  server_name your_server;
  root /var/www/laravel/public;

  location / {
    try_files $uri $uri/ /index.php?$query_string;
  }

  location ~ \.php$ {
    include fastcgi_params;
    fastcgi_pass unix:/run/php/php8.2-fpm.sock;
    fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
  }
}
```

---

# Slide 21 — Testing Deployment

* `curl http://server/api/users`
* Ensure Sanctum tokens work

---

# Slide 22 — Security Notes

* Sanctum token expiration strategies
* Use HTTPS in production
* Validate all inputs
* Add role-based authorization

---

# Slide 23 — Grading Checklist

* [x] ≥ 8 REST APIs
* [x] Token-protected routes
* [x] Tests included
* [x] MySQL migrations
* [x] Docker & deployment
* [x] Marp slides

---
