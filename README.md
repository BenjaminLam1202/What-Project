# What?Choose

this project will be my first project to build a free social to help people to make their choose if they cannot decide what they want , social friend will do it for them

## Getting Started

this project is running using laravel and this is indivitual project not getting and reponser or request by anyone 

### Prerequisites

this project is running using laravel framework so what you need to do is install everything with a laravel project environtment need and also composer

```
https://laravel.com/docs/7.x
```
### Installing

some package require that you will need

```
composer create-project --prefer-dist laravel/laravel blog
```
```
composer require pragmarx/google2fa-laravel
```
```
composer require bacon/bacon-qr-code
```
```
composer require guzzlehttp/guzzle
```
After that publish all the package your just installed
```
php artisan vendor:publish
```
Because we going to use storage to save image you gonna need to run this code
```
php artisan storage:link
```

okay we good to go


## Deployment

Apache you going to need a sql for this website

copy my .env.examples

```
cp .env.examples .env
```
fix your .env to match with your database 

```
DB_DATABASE=<YOUR-DATABASE>
DB_USERNAME=<YOUR-USERNAME>
DB_PASSWORD=<YOUR-PASSWORK>
```

also you need to fix your mail in order to send the qr code

```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=<YOUR-EMAIL>
MAIL_PASSWORD=<YOUR-PASSWORD>
MAIL_ENCRYPTION=<TYPE-OF-ENCRYTION>
MAIL_FROM_NAME="${APP_NAME}"
```
![Notice](https://via.placeholder.com/15/f03c15/000000?text=+)
if you using gmail , you cannot view qr code at least if you deloy the page to actual .com domain . So the solution is that we using mailtrap for testing

config this in config\service.php 
```
    'google' => [
        'client_id' => '275382881455-ph7f6q0r2mev0m4j65kb0knsobb1eaa0.apps.googleusercontent.com',
        'client_secret' => 'VSZDN8HZDJ18JsVjlK4Kn28f',
        'redirect' => 'http://full.hilton.com/callback/google',
    ],
```
fix AppURL and Domain 
```
APP_URL=http:http://<YOURS-URL>
```
```
DOMAIN=<YOURS-URL>
```
okay you good to go 

## Built With

* [pragmarx](https://github.com/antonioribeiro/google2fa-laravel)
* [BaconQrCode](https://github.com/Bacon/BaconQrCode)

## With Document from 
- **[Nguyen Van Giang ](https://viblo.asia/p/laravel-57-two-factor-authentication-with-google2fa-E375z0n1ZGW)**
- **[Dương đình Mạnh ](https://viblo.asia/p/login-vao-ung-dung-bang-tai-khoan-google-924lJqO0ZPM)**
## Authors

* **Benjamin Lam- Lâm Thái Gia Huy** - who participated in this project.

## Acknowledgments

* code for anyone who need anyone whose code was used
* Inspiration
* still in progress
* etc

