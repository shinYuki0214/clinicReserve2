@extends('layouts.app')

@section('content')
@if(Auth::check())
    <div class="top__title">ようこそ{{Auth::user()->name }}さん</div>
                        {{-- ユーザ詳細ページへのリンク --}}
                        @if(Auth::user()->role === 1)
                        <p>{!! link_to_route('signup.get', 'ユーザー登録') !!}</p>
                        <p>{!! link_to_route('users.index', '医院一覧') !!}</p>
                        @else
                        <div class="row">
                        {!! link_to_route('clinic.edit', '診療時間編集', [], ['class' => 'btn btn-lg btn-primary col']) !!}
                        {!! link_to_route('clinic.show', '予約状況', [], ['class' => 'btn btn-lg btn-primary col']) !!}
                        {!! link_to_route('reserve.show', '予約', [], ['class' => 'btn btn-lg btn-primary col']) !!}
                        </div>
                        @endif
@else
    <div class="center jumbotron">
        <div class="text-center">
            <h1>予約システム</h1>
            {{-- ログインへのリンク --}}
            {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    </div>
@endif
@endsection