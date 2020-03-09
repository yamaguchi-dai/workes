<!DOCTYPE html>
<html lang="{{ config('app.locale')}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api_token" content="{{ $api_token ?? ''}}">

    <title>アプリ名 - @yield('title')</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>

<body>
<div id="app" style="margin-top: 20%">
    <div class="container">
        @yield('content')
    </div>
</div>

<!--vue.jsのコンポートなどをロードするので、app.jsは全てのコンポートのあとに追加する。-->
<script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
