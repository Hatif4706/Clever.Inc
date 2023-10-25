# Nevada (Vendor Management)

<p align="center">
    <img src="/public/images/logo-with-text.png" />
</p>

<p align="center">Neuron Vendor Data Application</p>

## About

Nevada is a website for managing vendors starting from registration, projects and tenders management. With this application, it is hoped that. The vendor management process can be carried out systematically and help support work both for Account Manager, Logistic, Admin or the Vendor itself.

<p align="center">
    <img src="/public/images/preview.png" width="80%" />
</p>

## Requirements

1. PHP

2. Composer

3. NodeJS

4. MySQL

## Getting started

1. Clone this repository & install dependencies

```
git clone https://git.neuron.id/products/vendor-management.git
cd vendor-management
composer install
npm install
```

2. Create `.env` file

```
cat .env.example > .env
```
Ask for the recaptcha key and email configuration so that the signin and forgot password feature can work properly or you can make your own configuration.

4. Run migration with seeder

```
php artisan migrate:fresh --seed
```

5. Generate app key

```
php artisan key:generate
```

6. Create symbolic link

```
php artisan storage:link
```

7. Run this in different terminal

```
npm run dev
php artisan serve
```

8. Open `localhost:8000`

## Default account

Account Manager

* Email: accountmanager@gmail.com
* Password: password

You can see other users on the dashboard. All account passwords are `password`.

## Credits

Thanks to Nevada Team for doing a great job on TEFA, whose members are:

1. Aura Putri Kireina

2. Davin Septian Mindra

3. Habib Budin

4. Januari Maulani Putri

5. Nadif Dzaikra Hartaman

6. Najwan Aribena Pratama

7. Naufal Mahardianto

8. Razan M. Fauzan Sya'bani
