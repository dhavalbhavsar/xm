## Task
In this exercise you need to create a PHP application that will have a form with the following fields:
- Company Symbol
- Start Date (YYYY-mm-dd)
- End Date (YYYY-mm-dd)
- Email

## Installation

For manual installation follow the steps

- git clone https://github.com/dhavalbhavsar/xm.git
- copy .env.example .env and update database setting
- composer install
- npm install && npm run build
- php artisan migrate
- php artisan db:seed --class=CompanySeeder --force
- php artisan key:generate
- (Optional) Set your SMTP setting for send email (default set - log)
