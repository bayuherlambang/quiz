@extends('layouts.app')

@section('content')
    <!-- <h3 class="page-title">@lang('quickadmin.laravel-quiz')</h3> -->
    {!! Form::open(['method' => 'POST', 'route' => ['tests.store']]) !!}
    <div class="card">
        <div class="card-header">
            @lang('quickadmin.quiz')
        </div>
        <?php //dd($questions) ?>
    @if(count($questions) > 0)
        <div class="card-body">
        <?php $i = 1; ?>
        @foreach($questions as $question)
            @if ($i > 1)  @endif
            <div class="row question" style="display: none;" id="question[{{$i}}]" data-time="{{$question->time}}">

                <div class="col-md-12 form-group">
                    <div class="form-group">
                        <p>Question {{ $i }}.<br />{!! nl2br($question->question_text) !!}</p>
                        @if ($question->code_snippet != '')
                            <div class="code_snippet">"{!! $question->code_snippet !!}"</div>
                        @endif
                        <input
                            type="hidden"
                            name="questions[{{ $i }}]"
                            value="{{ $question->id }}">
                    @if($question->essay)
                        <div class="col-md-12 form-group">
                            {!! Form::label('essay_answer', 'Answer*', ['class' => 'control-label']) !!}
                            <textarea
                                name="essay_answers[{{ $question->id }}]"
                                class="form-control"
                                height="3"
                            ></textarea>
                            <p class="help-block"></p>
                            @if($errors->has('essay_answer'))
                                <p class="help-block">
                                    {{ $errors->first('essay_answer') }}
                                </p>
                            @endif
                        </div>
                    @endif
                    @foreach($question->options as $option)
                        <br>
                        <label class="radio-inline">
                            <input
                                type="radio"
                                name="answers[{{ $question->id }}]"
                                value="{{ $option->id }}">
                            {{ $option->option }}
                        </label>
                    @endforeach
                    </div>
                    <label id="time_remaining" style="color : red"></label>
                    <label>second time remaining to answer.</label>
                </div>
            </div>
        <?php $i++; ?>
        @endforeach
        </div>
    @endif
    </div>

    {!! Form::submit(trans('quickadmin.submit_quiz'), ['class' => 'btn btn-danger', 'id' => 'sumbit', 'style'=> 'display:none;'] ) !!}
    {!! Form::close() !!}
    <div id="test"></div>
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
        /** ndasmet started here.. */
        $(document).ready(function() {
          var questions = document.getElementsByClassName("question");
          loadQuestion();
          var skip = false;
          async function loadQuestion(){
            for(var i=0; i<questions.length; i++){
              questions[i].style.display='contents';

              var domElement = questions[i];
              var time = domElement.dataset.time;

              for(var x = 0; x < time ; x++){
                await sleep();
                var remaining = time - x;
                $(questions[i]).find("label[id=time_remaining]").html(remaining);
              }
              questions[i].style.display='none';
            }
            document.getElementById("sumbit").click();
          }
          document.getElementById("skip").onclick = function(){
            skip = true;
          }

          function sleep() {
            //sleep 1 detik
            var ms = 1000;
            return new Promise(resolve => setTimeout(resolve, ms));
          }
          Array.prototype.except = function(val) {
              return this.filter(function(x) { return x !== val; });
          };
        });

    </script>

@stop
