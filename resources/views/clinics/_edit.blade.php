@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            @include('clinics.card')
        </aside>
        <div class="col-sm-8">
            @include('clinics.nav')
            <div class="">
                
                <!--@foreach($consultaion_hours as $consultaion_hour)-->
                <!--    {{$consultaion_hour}}-->
                <!--@endforeach-->
                <table class="table">
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
                            {{ Form::open(['route' => ['clinic.closed'],'method' => 'delete']) }} 
                                @csrf
                                {{ Form::hidden('week',$weeks[$i]) }}
                                {{ Form::hidden('time',$timePeriod) }}
                                {{ Form::submit('〇', ['class'=>'',]) }}
                            {{ Form::close() }}
                        @else
                            <!--なければ✕でフォーム送信-->
                            {{ Form::open(['route' => ['clinic.opened']]) }} 
                            @csrf
                                {{ Form::hidden('week',$weeks[$i]) }}
                                {{ Form::hidden('time',$timePeriod) }}
                                {{ Form::submit('-', ['class'=>'',]) }}
                            {{ Form::close() }}
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