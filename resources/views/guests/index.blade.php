@extends('layouts.app2')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="text-center">注意事項</h1>
            <p>
                当院で診療を受けたことがない方のみ<br>
                ※当日キャンセルされる方は恐れ入りますが、お電話にてご連絡をお願いしております。<br>
                ※来院されたことがある方が予約をとられた場合お待ち頂くお時間が30分程ございます。（治療内容によっては改めてご予約をとりなおして頂く場合もございますのでご了承下さい。）
            </p>
           {!! link_to_route('guest.show', '予約', ['id' => $user->id], ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
@endsection