<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>予約システム</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <style>
            .footer{
                padding: 40px 16px;
                background-color:#eee;
            }
            .mainContent{
                padding: 40px 16px;
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-light bg-light">
          <div class="container-fluid">
            <span class="navbar-text">
              {{$user->name}}
            </span>
          </div>
        </nav>
        <div class="container mainContent">
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')

            @yield('content')
        </div>
        

        <div class="footer">
            <div class="container">
                 <div class="row align-items-start">
                    <div class="col">
                      医院の詳細
                    </div>
                    <div class="col">
                      診療時間
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>