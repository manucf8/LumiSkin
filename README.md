# LumiSkin

## Requirements

1. Have [XAMPP](https://www.apachefriends.org/) installed in your computer.
2. Have [Composer](https://getcomposer.org/download/) installed in your computer.

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
- Run php artisan key:generate to generate a new application key.

## Migrations
- Before running the application, run this command `php artisan migrate` to apply migrations.

## Running the app

1. Start Apache and MySQL in the XAMPP Control Panel.
2. Navigate to the project directory in your terminal.
3. Run `php artisan serve`
4. Access the URL that is shown in the terminal. Usually it's localhost, or `http://127.0.0.1:8000`
