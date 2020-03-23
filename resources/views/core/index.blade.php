<!DOCTYPE html>
<html lang="{{ config('app.locale')}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api_token" content="{{ $api_token ?? ''}}">

    <title>アプリ名 - @yield('title')</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    @include('core.head')
</head>

<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div id="app" style="margin-top: 20%">
    <div class="container">
        @yield('content')
    </div>
</div>

<!--vue.jsのコンポートなどをロードするので、app.jsは全てのコンポートのあとに追加する。-->
<script src="{{ mix('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- フラッシュメッセージ -->
<script>
    @if (session('info_msg'))
    $(function () {
        toastr.success('{{ session('info_msg') }}');
    });
    @endif
</script>
</body>

</html>
