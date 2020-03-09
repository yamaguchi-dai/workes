<!DOCTYPE html>
<html lang="{{ config('app.locale')}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ログイン</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>

<body>
<div id="app">
    <div class="container">
        <div class="card mx-auto" style="width:23rem;margin-top:25%">
            <div class="card-header">
                ログイン
            </div>
            <div class="card-body">
                <form action="{{route('login')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">メールアドレス</label>
                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="">
                        <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">パスワード</label>
                        <input type="password" class="form-control" name="password" placeholder="">
                    </div>
                    <button type="submit" class="btn btn-primary">ログイン</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--vue.jsのコンポートなどをロードするので、app.jsは全てのコンポートのあとに追加する。-->
<script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
