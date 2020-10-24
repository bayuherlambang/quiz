@extends('layouts.app')

@section('content')
    <!-- <h3 class="page-title">@lang('quickadmin.results.title')</h3> -->

    <div class="card">
        <div class="card-header">
            @lang('quickadmin.view-result')
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        @if(Auth::user()->isAdmin())
                        <tr>
                            <th>@lang('quickadmin.results.fields.user')</th>
                            <td>{{ $test->user->name or '' }} ({{ $test->user->email or '' }})</td>
                        </tr>
                        @endif
                        <tr>
                            <th>@lang('quickadmin.results.fields.date')</th>
                            <td>{{ $test->created_at or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.results.fields.result')</th>
                            <td>{{ $test->result }}</td>
                        </tr>
                    </table>
                <?php $i = 1 ?>
                @foreach($results as $result)
                    <table class="table table-bordered table-striped">
                        @if($result->question->essay)
                          @if(!$result->essay_answer)
                          <tr class="test-option-false">
                              <th style="width: 10%">Question #{{ $i }}</th>
                              <th class="wrap">{{ $result->question->question_text or '' }}</th>
                          </tr>
                          @else
                          <tr class="">
                              <th style="width: 10%">Question #{{ $i }}</th>
                              <th class="wrap">{{ $result->question->question_text or '' }}</th>
                          </tr>
                          @endif
                        @else
                        <tr class="test-option{{ $result->correct ? '-true' : '-false' }}">
                            <th style="width: 10%">Question #{{ $i }}</th>
                            <th class="wrap">{{ $result->question->question_text or '' }}</th>
                        </tr>
                        @endif
                        @if ($result->question->code_snippet != '')
                            <tr>
                                <td>Code snippet</td>
                                <td><div class="code_snippet wrap">{!! $result->question->code_snippet !!}</div></td>
                            </tr>
                        @endif
                        <tr>
                            <td >Answer</td>
                            <td class="wrap">
                                @if($result->question->essay)
                                  {{$result->essay_answer}}
                                @endif
                                <ul>
                                @foreach($result->question->options as $option)
                                    <li style="@if ($option->correct == 1) font-weight: bold; @endif
                                        @if ($result->option_id == $option->id) text-decoration: underline @endif">{{ $option->option }}
                                        @if ($option->correct == 1) <em>(correct answer)</em> @endif
                                        @if ($result->option_id == $option->id) <em>(your answer)</em> @endif
                                    </li>
                                @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Answer Explanation</td>
                            <td class="wrap">
                            {!! $result->question->answer_explanation  !!}
                                @if ($result->question->more_info_link != '')
                                    <br>
                                    <br>
                                    Read more:
                                    <a href="{{ $result->question->more_info_link }}" target="_blank">{{ $result->question->more_info_link }}</a>
                                @endif
                            </td>
                        </tr>
                    </table>
                <?php $i++ ?>
                @endforeach
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('tests.index') }}" class="btn btn-default">Take another quiz</a>
            <a href="{{ route('results.index') }}" class="btn btn-default">See all my results</a>
        </div>
    </div>
    <style>
    .wrap {
    	word-break : break-word !important;
    }

    </style>
@stop
