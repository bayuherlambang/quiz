<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Question;
use App\Result;
use App\Test;
use App\User;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siteTitle = 'Dashboard';
        $questions = Question::count();
        $users = User::where('role_id', 2)->count();
        $quizzes = Test::count();
        $average = Test::avg('result');

        $resultByUser = Test::all()->load('user');
        $quizzezByUser = Test::all()->load('user');
        $averageByUser = Test::all()->load('user');

        if (!Auth::user()->isAdmin()) {
            $results = $resultByUser->where('user_id', '=', Auth::id());
            $quizzes = $quizzezByUser->where('user_id', '=', Auth::id())->count();
            $average = $averageByUser->where('user_id', '=', Auth::id())->avg('result');
        }

        return view('home', compact('questions', 'users', 'quizzes', 'average', 'resultByUser', 'siteTitle'));
    }
}
