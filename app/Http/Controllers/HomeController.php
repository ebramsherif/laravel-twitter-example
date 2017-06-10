<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Tweet;
use DB;
use Auth;
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
        $current_user = Auth::user()->id;
        $users = DB::table("user_user")->where('follower_id',$current_user)->pluck("followed_id");
        array_push($users,$current_user);
        $tweets = Tweet::whereIn('user_id',$users)->orderBy('created_at', 'desc')->get();
        return view('home',['tweets'=>$tweets]);
    }
    
    public function activity(){
        $current_user = Auth::user()->id;
        $users = DB::table("user_user")->where('follower_id',$current_user)->pluck("followed_id");
        $likes = DB::table('tweet_user')->whereIn('user_id',$users)->orderBy('created_at', 'desc')->get();
        $follows = DB::table('user_user')->whereIn('follower_id',$users)->orderBy('created_at', 'desc')->get();
        return view('activity',['likes'=>$likes,'follows'=>$follows]);
    }
}
