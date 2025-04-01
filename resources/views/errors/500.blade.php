<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error</title>
    @vite(['resources/css/app.css'])
    <script src="https://browser.sentry-cdn.com/7.108.0/bundle.min.js"></script>
    <script>
        Sentry.init({ dsn: "{{ config('sentry.dsn') }}" });
    </script>
</head>
<body>
    <div class="container">
        <h1>Server Error</h1>
        <p>Sorry, something went wrong on our servers while we were processing your request.</p>

        @if(app()->bound('sentry') && !empty(Sentry::getLastEventId()))
            <div class="subtitle">Error ID: {{ Sentry::getLastEventId() }}</div>

            <script>
                Sentry.showReportDialog({
                    eventId: '{{ Sentry::getLastEventId() }}',
                });
            </script>
        @endif
    </div>
</body>
</html>
