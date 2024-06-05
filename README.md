# Simple Blog Project

This is a simple blog application built with Laravel 10, PHP 8.3.1, and PostgreSQL 14. The project allows users to view articles, and if they are logged in, they can add, edit, or delete categories, tags, and articles. This project also includes automated tests for each functionality and uses Laravel UI (Bootstrap) for the user interface. This project is based on the LaravelDaily Beginner Challenge, specified in this [repository](https://github.com/LaravelDaily/Laravel-Roadmap-Beginner-Challenge).

## Features

- View all articles
- Add, edit, and delete articles (for logged-in users)
- Add, edit, and delete categories (for logged-in users)
- Add, edit, and delete tags (for logged-in users)
- User authentication (login and registration)
- Automated tests for all functionalities
- User interface built with Laravel UI (Bootstrap)

## Requirements

- PHP 8.3.1
- PostgreSQL 14
- Composer
- Node.js and npm

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/yourusername/your-repo-name.git
    ```

2. Navigate to the project directory:

    ```bash
    cd your-repo-name
    ```

3. Install the dependencies:

    ```bash
    composer install
    npm install
    npm run dev
    ```

4. Set up the environment variables:

    ```bash
    cp .env.example .env
    ```

   Update the `.env` file with your database credentials and other settings.

5. Generate the application key:

    ```bash
    php artisan key:generate
    ```

6. Run the database migrations:

    ```bash
    php artisan migrate
    ```

7. Seed the database (optional):

    ```bash
    php artisan db:seed
    ```

8. Serve the application:

    ```bash
    php artisan serve
    ```

   The application will be available at `http://localhost:8000`.

## Running Tests

To run the automated tests, use the following command:

```bash
composer test
```

## Acknowledgements
LaravelDaily for providing the challenge and resources.
