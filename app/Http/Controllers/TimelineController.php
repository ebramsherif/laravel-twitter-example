<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tweet;
use Auth;
use DB;

class TimelineController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $tweets = DB::table('tweets')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('timeline',['tweets'=>$tweets]);
    }
}
