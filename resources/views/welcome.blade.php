<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome</title>

        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
    </head>
    <body class="antialiased">
        <a href="{!! route('user.change-language', ['en']) !!}" style="color: red">English</a>
        <br>
        <a href="{!! route('user.change-language', ['vi']) !!}" style="color: red">Vietnam</a>
        <br>
        {{ trans('messages.welcome') }}
    </body>
</html>