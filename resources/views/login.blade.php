@extends('core.index')
@section('title', 'Page Title')
@section('content')
    <div class="card mx-auto" style="width:23rem">
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
@endsection
