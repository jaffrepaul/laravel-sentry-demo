# Laravel Form Demo with Sentry Integration

A simple form submission demo built with Laravel, Vite, and Sentry error tracking.

## Requirements

-   PHP 8.1 or higher
-   Composer
-   Node.js & NPM
-   Laravel 10.x
-   SQLite
-   Sentry account (free tier available)

## Installation

1. Clone the repository:

```bash
git clone https://github.com/jaffrepaul/laravel-sentry-demo.git
cd laravel-sentry-demo
```

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

6. Set up Sentry:

    - Create a free account at [Sentry.io](https://sentry.io)
    - Create a new project for PHP
    - Get your DSN from the project settings
    - Edit `.env` and add your Sentry DSN:

    ```env
    SENTRY_LARAVEL_DSN=your-sentry-dsn
    ```

7. Configure SQLite database:

```bash
touch database/database.sqlite
```

8. Run database migrations:

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

3. Visit `http://localhost:8000` in your browser

## Testing Sentry Integration

The application includes several ways to test Sentry error tracking:

1. **Frontend Errors**:

    - Submit the form with an email containing "test" to trigger a JavaScript error

2. **Test Error Routes**:
   Click the "Run All Test Endpoints" button on the form page to trigger different types of errors:

    - Basic exception (`/debug-sentry`) - Captured in Sentry
    - Database error (`/debug-db`) - Captured in Sentry
    - Authentication error (`/debug-auth`) - Captured in Sentry
    - 404 error (`/debug-not-found`) - Captured in Sentry
    - Custom error (`/trigger-error`) - Captured in Sentry

    All errors will be captured and visible in your Sentry dashboard.

### Testing User Feedback Feature

The application includes Sentry's user feedback feature that allows users to provide feedback when they encounter errors. Here's how to test it:

1. Make sure `APP_DEBUG=false` in your `.env` file to see the custom error pages
2. Visit one of these test endpoints to trigger an error:

    - `http://localhost:8000/trigger-error` - Triggers a general exception
    - `http://localhost:8000/debug-db` - Triggers a database error
    - `http://localhost:8000/debug-sentry` - Triggers a Sentry test error

3. You should see:

    - A feedback dialog where you can provide:
        - Your name
        - Your email
        - Your feedback about what happened

4. To view the submitted feedback:
    - Go to your Sentry dashboard (https://sentry.io)
    - Select your project
    - Click on "Issues" in the left sidebar
    - Find the error event that was triggered
    - Click on the event to view its details
    - Look for the "User Report" link in the error header

## Features

-   Simple contact form with name, email, and message fields
-   Form validation
-   Success message display
-   Responsive design
-   Modern styling with CSS
-   Sentry error tracking integration
-   Basic performance monitoring (page loads, API calls, SQL queries)
-   Session replay for error debugging

## Sentry Dashboard

After triggering errors, you can view them in your Sentry dashboard:

1. Log in to your Sentry account
2. Navigate to your project
3. Check the "Issues" section for errors
4. Check the "Performance" section for transaction traces
5. Check the "Replays" section for session replays
