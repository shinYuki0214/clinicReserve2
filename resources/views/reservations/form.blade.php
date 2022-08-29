@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            @include('clinics.card')
        </aside>
        <div class="col-sm-8">
            @include('clinics.nav')
                {{ Form::open(['route' => ['reserve.store'],'method'=> 'post']) }}
                @csrf
                    <div class="form-group">
                        予約日
                        <div class="form-control">
                            {{$thisMonth}}月{{$thisDay}}日 {{$thisTimePeriods}}～
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', 'お名前') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('tel', '電話番号') !!}
                        {!! Form::text('tel', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'メールアドレス') !!}
                        {{ Form::email('email', '', ['class'=>'form-control']) }}
                    </div>
                    {{ Form::submit('予約', ['class'=>'btn btn-primary',]) }}
                {{ Form::close() }}
            </div>
        </div>
        
    </div>
@endsection