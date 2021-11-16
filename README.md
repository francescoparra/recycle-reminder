# Recycle Reminder

An app to track the days of separate collection.

## Built With

  - [Php](https://www.php.net/)
  - [Laravel](https://laravel.com/)

## Getting Started

These instructions will give you a copy of the project up and running on
your local machine for development and testing purposes. 
See deployment for notes on deploying the project on a live system.

### Prerequisites

Requirements for the software and other tools to build, test and push 
- [Composer](https://getcomposer.org/)
- [Node](https://nodejs.org/it/download/)

### Installing

A step by step series of examples that tell you how to get a development
environment running

1. Clone the repo and cd to its root directory
   ```sh
   git clone https://github.com/francescoparra/recycle-reminder

   cd recycle
   ```
2. Install composer dependencies
   ```sh
   composer install
   ```
3. Install NPM packages
   ```sh
   npm install
   ```
5. Copy ".env.example" from the root folder and rename the copy to ".env".
   ```sh
   cp .env.example .env
   ```

6. Generate an app encryption key
   ```sh
   php artisan key:generate
   ```
7. Create an empty database: depending on your setup and system this may vary; you can refer to the [official documentation](https://dev.mysql.com/doc/refman/8.0/en/creating-database.html) or follow the instruction for the software you are using to handle MySQL. The name doesn't matter, I called mine "recycle" for consistency.

8. Update .env with your database connection settings in order to give the app access to it. In the .env file fill in the DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD options to match the credentials of the database you just created.
   ```sh
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE= yourDatabaseName
   DB_USERNAME= yourRootUsername
   DB_PASSWORD= yourPassword
   ```

9. Run migrations:
   ```sh
   php artisan migrate
   ```

10. Run the server and open the url you are serving it to on your browswer, usually http://127.0.0.1:8000.

    ```sh
    php artisan serve
    ```

## Usage

When you start you will find yourself on the home page, to use the application you will need to register. 

You will be redirected to the list page which will be empty, so continue with creating it. 

You can add categories to your liking, when the list is created you can modify it by adding or removing elements.

## Authors

  - **Francesco Parra**
    [GitHub](https://github.com/francescoparra)
    [Linkedin](https://www.linkedin.com/in/francescoparra/)


