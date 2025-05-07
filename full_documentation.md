I started by installing laravel(a web based php framework),
```bash
brew install php
```
I also needed to install composer, which is PHP's package manager(like npm for Node.js)
```bash
brew install composer
```
Created a new Laravel project 
```bash
Laravel chatapp
```
Then run the local server
```bash
cd chatapp
php artisan serve
```
Install Laravel authentication 
```bash
php artisan make: auth
```
Set upthe  database, will use SQLite
```bash
php artisan migrate
```

We have to create a Message model + migration

```bash
php artisan make: model Message -m
```

create a chatcontroller 

```bash
php artisan make:controller ChatController
```

create the messagesent event 
```bash
php artisan make:event MessageSent
```

setup a pusher for broadcasting 
install:
```bash
composer require pusher/pusher-php-server
```

install laravel echo and pusher js(frontend dependencies)
```bash
npm install --save laravel-echo pusher-js
```

build Vue components for chat
create chatmessage.vue
create chatform.vue
use componenets in our main page

setup routes in web.php

setup middleware authentication
```bash
\Illuminate\Session\Middleware\StartSession::class,
\Illuminate\View\Middleware\ShareErrorsFromSession::class,
```









