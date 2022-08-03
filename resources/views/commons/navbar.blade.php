<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        {{-- トップページへのリンク --}}
        <a class="navbar-brand" href="/">予約システム</a>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                @if(Auth::check())
                <!--start管理者権限のみの表示-->
                <li class="nav-item">
                    {{--医院一覧ページへのリンク --}}
                    {!! link_to_route('users.index', '医院一覧', [], ['class'=>'nav-link']) !!}
                </li>
                <!--end 管理者権限のみの表示-->
                <li class="nav-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                @else
                {{-- ユーザ登録ページへのリンク --}}
                <li class="nav-item">{!! link_to_route('signup.get', '医院登録', [], ['class' => 'nav-link']) !!}</li>
                {{-- ログインページへのリンク --}}
                <li class="nav-item"><a href="#" class="nav-link">ログイン</a></li>
                @endif
            </ul>
        </div>
    </nav>
</header>