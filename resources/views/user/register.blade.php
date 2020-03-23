@extends('core.index')
@section('title', ' ユーザー登録')
@section('content')
    <div class="card mx-auto">
        <div class="card-header">
            ユーザー登録
        </div>
        <div class="card-body">
            <form method="post" action="{{route('user.register.registration')}}">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <label for="user_name">ユーザー名</label>
                        <input type="text" class="form-control" id="user_name" name="user_name" value="{{old('user_name')}}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="email">Eメールアドレス</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                        <small class="text-muted">(ログインID)</small>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="password">パスワード</label>
                        <input type="password" class="form-control" id="password" name="password" value="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="confirm_password">パスワード(確認用)</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="">
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary col-2 offset-10">登録</button>
                </div>

            </form>
        </div>
    </div>
@endsection
