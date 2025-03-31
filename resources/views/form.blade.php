<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        window.SENTRY_DSN = "{{ config('sentry.dsn') }}";
    </script>
    <title>Contact Form</title>
</head>
<body>
    <div class="container">
        <h1>Contact Us</h1>

        <form action="{{ route('submit.form') }}" method="POST" novalidate>
            @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    @error('name') aria-invalid="true" @enderror
                >
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    @error('email') aria-invalid="true" @enderror
                >
                <small class="hint-text">Use test@email.com to trigger client-side error</small>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea
                    id="message"
                    name="message"
                    @error('message') aria-invalid="true" @enderror
                >{{ old('message') }}</textarea>
                @error('message')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Submit</button>
        </form>

        @if(session('success'))
            <div class="success-message" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="test-section">
            <h2>Break Stuff!!</h2>
            <p>Click the button below to trigger various errors that will display in Sentry</p>
            <button id="testEndpoints" class="test-button">Run All Test Endpoints</button>
            <div id="testResults" class="test-results"></div>
        </div>
    </div>
</body>
</html>
