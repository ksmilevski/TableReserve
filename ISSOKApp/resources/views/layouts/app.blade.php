<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
        }
        .btn-custom {
            background-color: #ff5733;
            color: white;
            border-radius: 8px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background-color: #c43d1b;
        }
    </style>
</head>
<body>

@include('layouts.navbar')

<div class="container mt-5">
    {{ $slot }}
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
