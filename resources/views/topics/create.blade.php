@extends('layouts.app')

@section('content')
    <!-- <h3 class="page-title">@lang('quickadmin.topics.title')</h3> -->
    {!! Form::open(['method' => 'POST', 'route' => ['topics.store']]) !!}

    <div class="card">
        <div class="card-header">
            @lang('quickadmin.create')
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12 form-group">
                    {!! Form::label('title', 'Title*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
                <div class="col-md-12 form-group">
                    {!! Form::label('open_date', 'Quiz Date*', ['class' => 'control-label']) !!}
                    {!! Form::date('open_date', old('open_date'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('open_date') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('quickadmin.save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
