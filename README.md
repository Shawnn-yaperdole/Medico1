# Medico - Clinic Management System

SABELA, SHAWN MICHAEL B.

DULNUAN, BRENZER ACE A.

A comprehensive clinic management system built with Laravel for managing patients, doctors, appointments, medical records, symptoms, and test results. This system is designed for healthcare professionals to efficiently manage their practice.

## STEPS AFTER CLONING AND TESTING

**1. Install PHP Dependencies:**

composer install


**2. Install Node.js Dependencies:**

npm install


**3. Configure Environment (.env):**

copy .env.example or cp .env.example .env

php artisan key:generate


**4. Configure Database:**

type nul > database\database.sqlite or touch database/database.sqlite

**5. Update your .env file:**

-Comment out or remove all other DB_* lines when using SQLite:

DB_CONNECTION=sqlite

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=laravel

DB_USERNAME=root

DB_PASSWORD=


-Or if you prefer MySQL:

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=medico

DB_USERNAME=root

DB_PASSWORD=yourpassword

-And then create the database when using MySQL:

CREATE DATABASE medico;

**6. Run Database Setup:**

php artisan migrate

php artisan db:seed


**7. Build assets and serve:**

npm run dev

php artisan serve

**8. Visit the page:**

open your browser and go to: http://127.0.0.1:8000 


## DEFAULT LOGIN CREDENTIALS:

**Admin:**

admin@example.com

password

**Doctor:** 

doctor@example.com

password

**Receptionist:** 

reception@example.com

password

**Patient:**

patient@example.com

password

