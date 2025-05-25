# LumiSkin
[![Ask DeepWiki](https://deepwiki.com/badge.svg)](https://deepwiki.com/manucf8/LumiSkin)

## Requirements

1. Have [XAMPP](https://www.apachefriends.org/) installed in your computer.
2. Have [Composer](https://getcomposer.org/download/) installed in your computer.
3. For the Skincare Test to work, you need to add an OpenAI API Key inside your .env file, like this:
   ```
   OPENAI_API_KEY=your_openai_api_key
   ```

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
  
### Dummy Data
If you wish to see the app's full potential without manually creating hundreds of products, you can use our pre-designed MySQL script.
- Steps
1. If you already had data inside the database, besides the tables creation, delete your database and create it again.
2. Run this command to create the tables `php artisan migrate`
3. Open the file `db.sql`. This is a SQL script that will generate the dummy data.
4. In `http://localhost/phpmyadmin/` click on your database, and look for a "SQL" button on the upper part of the page.
5. In there, copy and paste the contents of the script, and run it.
6. Copy all of the images in the `images` folder, and paste them inside the folder public/storage in the project's root directory.

## Running the app

1. Start Apache and MySQL in the XAMPP Control Panel.
2. Navigate to the project directory in your terminal.
3. Run `php artisan serve`
4. Access the URL that is shown in the terminal. Usually it's localhost, or `http://127.0.0.1:8000`

