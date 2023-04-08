## Task
In this exercise you need to create a PHP application that will have a form with the following fields:
- Company Symbol
- Start Date (YYYY-mm-dd)
- End Date (YYYY-mm-dd)
- Email

## Installation

For manual installation follow the steps

- git clone 
- copy .env.example .env
- composer install
- npm install && npm run build
- php artisan migrate
- php artisan db:seed --class=CompanySeeder --force
