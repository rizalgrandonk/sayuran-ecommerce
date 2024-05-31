<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Basic Ecommere

Ecommerce with Laravel

Cara Running:

1. buka terminal (ex: Git Bash)
2. run comand `git clone https://github.com/rizalgrandonk/sayuran-ecommerce.git`
3. run comand `cd sayuran-ecommerce`
4. run comand `mv .env.example`
5. buat database baru (terminal jangan ditutup)
6. ganti nama database di file .env `DB_DATABASE` sesuai nama database yang baru dibuat
7. buka lagi terminal sebelumnya
8. run comand `composer install`
9. run command `php artisan key:generate`
10. run command `php artisan migrate:fresh --seed`
11. run command `php artisan serve`
