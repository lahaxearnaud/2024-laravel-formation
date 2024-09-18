<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <div class="bg-white">
            <div class="mx-auto max-w-7xl px-6 py-8">
                <div id="app" data-token="{{ $userToken ?? ''}}"></div>
            </div>
        </div>


        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </body>
</html>
