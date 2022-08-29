@extends('layouts.app')

@section('content')
    <div class="">
        <aside class="">
            @include('clinics.card')
        </aside>
        <div class="">
            @include('clinics.nav')
            <div class="">
                <table class="table clinic_table">
                    <tr>
                        <th></th>
                        @foreach($dates as $date)
                            <?php 
                                $thisWeek = date('w', strtotime($date));
                                $thisMonth = date('n', strtotime($date));
                                $thisDay = date('d', strtotime($date));
                            ?>
                            <th class="text-center"><div>{{$thisMonth}}月{{$thisDay}}日</div>（{{$collectWeeks[$thisWeek]}}）</th>
                        @endforeach
                    </tr>
                   @foreach($timePeriods as $timePeriod)
                    <tr>
                        <td class="text-center">{{$timePeriod}}</td>
                        @foreach($dates as $date)
                            <?php 
                                $thisWeek = date('w', strtotime($date));
                            ?>
                            <td class="text-center"> <!--その日に予約があるかどうか-->
                                @if(\Auth::user()->reservations()->where('date', $date)->where('time', $timePeriod)->exists())
                            　　{{\Auth::user()->reservations()->where('date', $date)->where('time', $timePeriod)->first()->name}} 様
                                @else
                            <!--consultation_hoursのweekの値とtimeの値が同じものがあれば〇-->
                            @if(\Auth::user()->consultation_hours()->where('week', $collectWeeks[$thisWeek])->where('time', $timePeriod)->exists())
                               
                                〇
                            @else
                                <!--なければ✕でフォーム送信-->
                                -
                            @endif
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        
    </div>
@endsection