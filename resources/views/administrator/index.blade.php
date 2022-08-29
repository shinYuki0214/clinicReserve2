@extends('layouts.app')

@section('content')
{{-- ユーザー一覧 --}}
        <table class="table">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">医院名</th>
              <th scope="col">メールアドレス</th>
              <th scope="col">住所</th>
              <th scope="col">権限</th>
            </tr>
          </thead>
          <tbody>
              
    @foreach ($users as $user)
            <tr>
              <th scope="row">{{$user->id}}</th>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->address}}</td>
              <td>{{$user->role}}</td>
            </tr>
    @endforeach
          </tbody>
        </table>
@endsection