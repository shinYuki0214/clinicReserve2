@extends('layouts.app2')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div>以下の内容で承りました。</div>
            <table class="table">
              <tbody>
                <tr>
                  <th scope="row">お名前</th>
                  <td>{{$name}}</td>
                </tr>
                <tr>
                  <th scope="row">ご予約日</th>
                  <td>{{$month}}月{{$day}}日　{{$time}}</td>
                </tr>
                <tr>
                  <th scope="row">電話番号</th>
                  <td>{{$tel}}</td>
                </tr>
                <tr>
                  <th scope="row">メールアドレス</th>
                  <td>{{$email}}</td>
                </tr>
              </tbody>
            </table>
           {!! link_to_route('guest.index', 'トップページへ戻る', ['id' => $user->id], ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
@endsection