<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://browser.sentry-cdn.com/7.108.0/bundle.tracing.min.js" crossorigin="anonymous"></script>
    <script>
        window.SENTRY_DSN = "{{ config('sentry.dsn') }}";

        // Initialize Sentry
        Sentry.init({
            dsn: window.SENTRY_DSN,
            integrations: [
                new Sentry.BrowserTracing(),
            ],
            tracesSampleRate: 1.0,
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>404 - Page Not Found</h1>
        <p class="subtitle">The page you're looking for doesn't exist.</p>
    </div>
</body>
</html>
