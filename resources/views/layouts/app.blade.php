<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>予約システム</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <style>
        .addTime{
            cursor:pointer;
            text-align:center;
            text-decoration: underline;
            color: blue;
        }
        .table td, .table th{
            text-align: center;
        }
        .top__title{
            font-size: 24px;
            padding-bottom: 16px;
        }
        .clinic_table tr:first-child{
            position: sticky;
            top: 0;
            left: 0;
            backcground-color:#fff;
        }
        
        .clinic_table tr:first-child th{
            background: #fff;
            border-bottom: 2px solid #aaa;
        }
        </style>
    </head>

    <body>

        {{-- ナビゲーションバー --}}
        @include('commons.navbar')

        <div class="container">
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')

            @yield('content')
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        <script>
            $(function(){
                let theTime = $('.js__ajax-data');
                theTime.on('click', function(){
                    console.log('発火');
                    let $this = $(this);
                    theWeek = $this.data('week');
                    theTime = $this.data('time');
                    
                    //ajax処理スタート
                    $.ajax({
                        headers:{
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }, //name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
                        url: '/clinic/opened',//通信先アドレスで、このURLをあとでルートで設定します
                        method: 'POST',//Httpメソッドの種別を指定します。
                        data:{
                            'week':theWeek,
                            'time':theTime
                        },
                    }).done(function(data){
                        $this.html(data.data);
                    }).fail(function(){
                        console.log('fail');
                    });
                });
            });
        </script>
    </body>
</html>