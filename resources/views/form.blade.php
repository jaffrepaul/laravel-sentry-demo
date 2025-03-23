<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Form Submission</title>
</head>
<body>
    <form action="{{ route('submit.form') }}" method="POST">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" required>
        <br>
        <label>Message:</label>
        <textarea name="message" required></textarea>
        <br>
        <button type="submit">Submit</button>
    </form>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif
</body>
</html>
