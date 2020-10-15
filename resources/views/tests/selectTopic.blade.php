@extends('layouts.app')

@section('content')
    <!-- <h3 class="page-title">@lang('quickadmin.setSKill')</h3> -->
    <!-- {!! Form::open(['method' => 'POST', 'route' => ['tests.store']]) !!} -->

    <div class="card">
        <div class="card-header">
            @lang('quickadmin.SkillTitle')
        </div>
        <div class="card-body">
          @foreach($topics as $topic)
            {!! Form::open(['route' => ['setTopic', $topic->id], 'method' => 'PUT']) !!}
                {{Form::button($topic->title, ['type' =>'submit', 'class' => 'submit-btn btn btn-success'])}}
            {!!Form::close() !!}
            <br>
          @endforeach
        </div>
    </div>

    <!-- {!! Form::submit(trans('quickadmin.submit_quiz'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!} -->
@stop

@section('javascript')
    @parent
    <script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <script>
        $('.datetime').datetimepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}",
            timeFormat: "hh:mm:ss"
        });
    </script>

@stop
