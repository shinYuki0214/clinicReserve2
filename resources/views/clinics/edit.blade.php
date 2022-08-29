@extends('layouts.app')

@section('content')
    <div class="">
        <aside class="">
            @include('clinics.card')
        </aside>
        <div class="">
            @include('clinics.nav')
            <div class="">
                
                <!--@foreach($consultaion_hours as $consultaion_hour)-->
                <!--    {{$consultaion_hour}}-->
                <!--@endforeach-->
                <table class="table clinic_table">
                    <tr>
                        <th></th>
                        @for($i = 0; $i<7; $i++)
                            <th>{{$weeks[$i]}}</th>
                        @endfor
                    </tr>
                   @foreach($timePeriods as $timePeriod)
                    <tr>
                        <td>{{$timePeriod}}</td>
                        @for($i = 0; $i < 7; $i++)
                        <td>
                        <!--consultation_hoursのweekの値とtimeの値が同じものがあれば〇-->
                        <!-- ConsultationHour::isExists($consultaion_hours, $weeks[$i], $timePeriod) -->
                        <!--　↓の記述はuserのモデルにもっていく　-->
                        @if(\Auth::user()->consultation_hours()->where('week', $weeks[$i])->where('time', $timePeriod)->exists())
                            <!--なければ✕でフォーム送信-->
                            <span class="addTime js__ajax-data" data-week="{{$weeks[$i]}}" data-time="{{$timePeriod}}">
                                〇
                            </span>
                        @else
                            <!--なければ✕でフォーム送信-->
                            <span class="addTime js__ajax-data" data-week="{{$weeks[$i]}}" data-time="{{$timePeriod}}">
                                -
                            </span>
                        
                        @endif
                        </td>
                        @endfor 
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        
    </div>
@endsection