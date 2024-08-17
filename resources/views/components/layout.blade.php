<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <script defer src="{{ asset('bootstrap.bundle.min.js') }}"></script>
    <script defer src="{{ asset('scripts.js') }}"></script>

    {{ $head ?? "" }}

    <title>{{ $title ?? "Layout" }}</title>
</head>
<body>
    {{ $slot  }}
</body>
</html>
