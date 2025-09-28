<!DOCTYPE html>
<html lang="en" data-theme="business">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel App</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body class="min-h-screen flex flex-col bg-base-200 font-sans antialiased">
    <x-navbar />
    <main class="hero min-h-screen container mx-auto my-4">
        <div class="hero-content flex-col">
            {{ $slot }}
        </div>
    </main>
    <x-footer />
</body>

</html>
