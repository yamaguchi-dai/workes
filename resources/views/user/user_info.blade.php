@extends('core.index')
@section('title', 'Page Title')
@section('content')
    <div class="card mx-auto">
        <div class="card-header">
            アカウント設定
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <div class="row">
                        <label for="email">Eメールアドレス</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$user['email']}}">
                        <small class="text-muted">ログインIDも変更されます</small>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label for="token">APIKey</label>
                    </div>
                    <div class="row">
                        <input readonly type="text" class="form-control col-9" id="token" value="{{$user->userToken()['token']}}">
                        <button type="button" class="btn btn-primary col-2 offset-1">key更新</button>
                    </div>
                    <div class="row">
                        <small class="text-muted">APITokenの変更</small>
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
                    <button type="submit" class="btn btn-primary col-2 offset-10">更新</button>
                </div>

            </form>
        </div>
    </div>
@endsection
