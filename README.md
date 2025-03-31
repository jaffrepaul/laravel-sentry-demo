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
git clone https://github.com/yourusername/laravel-sentry-demo.git
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

6. Configure SQLite database:

```bash
touch database/database.sqlite
```

Then update your `.env` file to use SQLite:

```env
DB_CONNECTION=sqlite
```

7. Set up Sentry:

    - Create a free account at [Sentry.io](https://sentry.io)
    - Create a new project for PHP
    - Get your DSN from the project settings
    - Copy `.env.example` to `.env` and add your DSN:

    ```bash
    cp .env.example .env
    ```

    - Edit `.env` and add your Sentry DSN:

    ```env
    SENTRY_LARAVEL_DSN=your-sentry-dsn
    ```

    > **Important**: Never commit your Sentry DSN to version control. Each reviewer should use their own Sentry account and DSN.

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

1. **Form Validation Errors**:

    - Submit the form with empty fields
    - Submit with invalid email format
    - Submit with fields exceeding maximum length

2. **Test Error Routes**:
   Click the "Run All Test Endpoints" button on the form page to trigger different types of errors:

    - Basic exception
    - Database error
    - Validation error
    - Authentication error
    - 404 error
    - Custom error

3. **Frontend Errors**:
    - Submit the form with an email containing "test" to trigger a JavaScript error

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
-   Sentry error tracking integration
-   Performance monitoring
-   Session replay for error debugging

## Sentry Dashboard

After triggering errors, you can view them in your Sentry dashboard:

1. Log in to your Sentry account
2. Navigate to your project
3. Check the "Issues" section for errors
4. Check the "Performance" section for transaction traces
5. Check the "Replays" section for session replays

## Steps for Reviewers

### 1. Initial Setup

1. Clone the repository
2. Follow the Installation steps above
3. Create a Sentry account and project
4. Add your Sentry DSN to the `.env` file

### 2. Start the Application

1. Run `php artisan serve`
2. Run `npm run dev` in a separate terminal
3. Visit `http://localhost:8000`

### 3. Test Form Validation

1. Submit the form with empty fields:
    - Leave all fields empty and click Submit
    - Check Sentry dashboard for validation errors
2. Submit with invalid email:
    - Enter a name and message
    - Enter an invalid email (e.g., "not-an-email")
    - Click Submit
    - Check Sentry dashboard for validation errors
3. Submit with long text:
    - Enter text longer than 1000 characters in the message field
    - Click Submit
    - Check Sentry dashboard for validation errors

### 4. Test Error Routes

Click the "Run All Test Endpoints" button on the form page to trigger all test errors at once. This will:

1. Trigger a basic exception
2. Trigger a database error
3. Trigger a validation error
4. Trigger an authentication error
5. Trigger a 404 error
6. Trigger a custom error

Watch the results appear in real-time on the page and check your Sentry dashboard for the captured errors.

### 5. Test Frontend Errors

1. Enter an email containing "test" in the form
2. Submit the form
3. Check Sentry dashboard for JavaScript error

### 6. Check Sentry Dashboard

For each error triggered, verify in Sentry:

1. Error details are captured
2. Stack trace is available
3. Request data is included
4. Performance data is recorded
5. Session replay is available (for frontend errors)

### 7. Verify Performance Monitoring

1. Submit the form with valid data
2. Check Sentry Performance section
3. Verify:
    - Transaction timing
    - Database queries
    - Cache operations
    - Response time

### 8. Review Code Quality

1. Check the implementation of:
    - Form validation
    - Error handling
    - Sentry integration
    - Frontend error tracking
    - Performance monitoring

## Notes for Reviewers

-   All errors are captured in Sentry with full context
-   Performance monitoring is enabled for all routes
-   Session replay is enabled for 10% of sessions and 100% of sessions with errors
-   The application uses SQLite for simplicity, but can be configured to use other databases
