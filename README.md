# Laravel Form Demo

A simple form submission demo built with Laravel and Vite.

## Requirements

-   PHP 8.1 or higher
-   Composer
-   Node.js & NPM
-   Laravel 10.x
-   SQLite

## Installation

1. Clone the repository
2. Install PHP dependencies:

```bash
composer install
```

3. Install NPM dependencies:

```bash
npm install
```

4. Copy the environment file:

```bash
cp .env.example .env
```

5. Generate application key:

```bash
php artisan key:generate
```

6. Configure SQLite database:

```bash
touch database/database.sqlite
```

Then update your `.env` file to use SQLite:

```env
DB_CONNECTION=sqlite
```

7. Run database migrations:

```bash
php artisan migrate
```

## Running the Application

1. Start the Laravel development server:

```bash
php artisan serve
```

2. In a separate terminal, start the Vite development server:

```bash
npm run dev
```

3. Visit `http://localhost:8000/form` in your browser

## Building for Production

To build assets for production:

```bash
npm run build
```

## Features

-   Simple contact form with name, email, and message fields
-   Form validation
-   Success message display
-   Responsive design
-   Modern styling with CSS
