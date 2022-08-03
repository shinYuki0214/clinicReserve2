@extends('layouts.app')

@section('content')
@if(Auth::check())
    {{Auth::user()->name }}
@else
    <div class="center jumbotron">
        <div class="text-center">
            <h1>予約システム</h1>
            {{-- ユーザ登録ページへのリンク --}}
            {!! link_to_route('signup.get', '医院登録', [], ['class' => 'btn btn-lg btn-primary']) !!}
            {{-- ログインへのリンク --}}
            <a href="#" class="btn btn-lg btn-primary">ログイン</a>
        </div>
    </div>
@endif
@endsection