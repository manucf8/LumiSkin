# LumiSkin

## Requirements

1. Have [XAMPP](https://www.apachefriends.org/) installed in your computer.
2. Have [Composer](https://getcomposer.org/download/) installed in your computer.
3. For the Skincare Test to work, you need to add an OpenAI API Key inside your .env file.

## Installation
- Clone the repository to your local machine.
- Navigate to the project directory in your terminal.
- Run `composer install` to install PHP dependencies.
- Copy the .env.example file to .env and configure your environment variables, like so:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
- Run `php artisan key:generate` to generate a new application key.

## Migrations
- Open XAMPP Control Panel  and start the modules Apache and MySQL.
- From there, click on MySQL admin or go to `http://localhost/phpmyadmin/`, and there, create a database with the same name that you defined in your .env (DB_DATABASE=your_database_name).
- Before running the application, run this command `php artisan migrate` to apply migrations.

## Running the app

1. Start Apache and MySQL in the XAMPP Control Panel.
2. Navigate to the project directory in your terminal.
3. Run `php artisan serve`
4. Access the URL that is shown in the terminal. Usually it's localhost, or `http://127.0.0.1:8000`
