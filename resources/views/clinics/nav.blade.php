<ul class="nav nav-tabs nav-justified mb-3">
    {{-- ユーザ詳細タブ --}}
    <li class="nav-item">{!! link_to_route('clinic.edit', '診療時間編集', [], ['class' => 'nav-link']) !!}</li>
    <li class="nav-item">{!! link_to_route('clinic.show', '予約状況', [], ['class' => 'nav-link']) !!}</li>
    <li class="nav-item">{!! link_to_route('reserve.show', '予約', [], ['class' => 'nav-link']) !!}</li>
</ul>