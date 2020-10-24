<?php

namespace App\Http\Controllers;
use Lang;
use DB;
use Auth;
use App\Test;
use App\TestAnswer;
use App\Topic;
use App\Result;
use App\Question;
use App\QuestionsOption;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTestRequest;

class TestsController extends Controller
{
    /**
     * Display a new test.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $topics = Topic::inRandomOrder()->limit(10)->get();
        /*
        $topic = 2;
        $questions = Question::where('topic_id', $topic)->inRandomOrder()->limit(10)->get();
        foreach ($questions as &$question) {
            $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
        }

        /*
        foreach ($topics as $topic) {
            if ($topic->questions->count()) {
                $questions[$topic->id]['topic'] = $topic->title;
                $questions[$topic->id]['questions'] = $topic->questions()->inRandomOrder()->first()->load('options')->toArray();
                shuffle($questions[$topic->id]['questions']['options']);
            }
        }
        */
        //$siteTitle = Lang::get('quickadmin.laravel-quiz');
        $siteTitle = Lang::get('quickadmin.setSKill');
        $today = date("Y-m-d");
        $topics = Topic::all()->where('open_date', '=', $today);
        //dd($topics);
        return view('tests.selectTopic', compact('topics', 'siteTitle'));
        //return view('tests.create', compact('$topic'));
    }

    public function checkEnrolledTopic($topic){
        $check = TestAnswer::where('user_id', '=', Auth::id())->first();
        if($check){
          $sample_question = $check->question_id;
          $topicOfQuestion = Question::find($sample_question);
          $getTopic = $topicOfQuestion->topic_id;
          $data = true;
        }else{
          $data = false;
        }
        echo json_encode($data);
    }

    public function getQuestion($topic)
    {
        // $topics = Topic::inRandomOrder()->limit(10)->get();
        //$topic = 2;
        $siteTitle = Lang::get('quickadmin.laravel-quiz');
        $questions = Question::where('topic_id', $topic)->inRandomOrder()->get();

        foreach ($questions as &$question) {
            //dd($question->essay);
            $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
        }

        /*
        foreach ($topics as $topic) {
            if ($topic->questions->count()) {
                $questions[$topic->id]['topic'] = $topic->title;
                $questions[$topic->id]['questions'] = $topic->questions()->inRandomOrder()->first()->load('options')->toArray();
                shuffle($questions[$topic->id]['questions']['options']);
            }
        }
        */
        return view('tests.create', compact('questions', 'siteTitle'));
    }

    /**
     * Store a newly solved Test in storage with results.
     *
     * @param  \App\Http\Requests\StoreResultsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $result = 0;

        $test = Test::create([
            'user_id' => Auth::id(),
            'result'  => $result,
        ]);

        foreach ($request->input('questions', []) as $key => $question) {
            $status = 0;

            if ($request->input('answers.'.$question) != null
                && QuestionsOption::find($request->input('answers.'.$question))->correct
            ) {
                $status = 1;
                $result++;
            }
            if ($request->input('essay_answers.'.$question) != null) {
                $status = 1;
                $result++;
            }


            TestAnswer::create([
                'user_id'     => Auth::id(),
                'test_id'     => $test->id,
                'question_id' => $question,
                'option_id'   => $request->input('answers.'.$question),
                'correct'     => $status,
                'essay_answer'=> $request->input('essay_answers.'.$question),
            ]);
        }

        $result = $result/sizeof($request->input('questions'));
        $test->update(['result' => round($result, 2)*100]);

        return redirect()->route('results.show', [$test->id]);
    }
}
