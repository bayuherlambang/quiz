@extends('layouts.app')

@section('content')

    <!-- {!! Form::open(['method' => 'POST', 'route' => ['tests.store']]) !!} -->

    <div class="card">
        <div class="card-header">
            @lang('quickadmin.SkillTitle')
        </div>
        <div class="card-body">
          @if(sizeof($topics) > 0)
            @foreach($topics as $topic)
              <button class="submit-btn btn btn-success" onclick="checkTopic({{$topic->id}})">{{$topic->title}}</button>
              {!! Form::open(['route' => ['setTopic', $topic->id], 'method' => 'PUT']) !!}
                  {{Form::button($topic->title, ['id'=>$topic->id, 'type' =>'submit', 'class' => 'submit-btn btn btn-success', 'style'=>'display:none'])}}
              {!!Form::close() !!}
              <br>
            @endforeach
          @else
              @lang('quickadmin.no_quiz_today')
          @endif
        </div>
    </div>

    <!-- {!! Form::submit(trans('quickadmin.submit_quiz'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!} -->
@stop

@section('javascript')

    @parent
    <script type="text/javascript">
    function checkTopic(id){
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             url: '{{ url('test/checktopic') }}/'+id,
             type: 'GET',
             dataType: 'json',
             success: function(response){
               if(response == false){
                 document.getElementById(id).click();
               }else{
                 alert('@lang('quickadmin.QuizTaked')');
               }
             }
          });
        }
    $(document).ready(function() {

      } );
    </script>
@stop
