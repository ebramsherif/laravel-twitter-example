<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tweet;
use Auth;
use DB;

class TweetController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(Request $request){
        $tweet = new Tweet;
        $tweet->user_id = Auth::user()->id;
        $tweet->body = $request->input('body');
        $tweet->save();
        return redirect()->back();
    }
    
    public function delete($id){
        $tweet = Tweet::find($id);
        if($tweet->user_id==Auth::user()->id)
            $tweet->delete();
        else{
            return redirect()->back()->with('alert','You cannot delete tweets you did not tweet');
        }
        return redirect()->back();
    }
    
    public function like($id){
        $user_id = Auth::user()->id;
        $tweet = Tweet::find($id);
        if(!DB::table('tweet_user')->where([
        ['user_id', '=', $user_id], ['tweet_id', '=', $id],])
        ->exists()){
            $tweet->likedBy()->attach(Auth::user()->id);
    }
        else{
            $tweet->likedBy()->detach(Auth::user()->id);
        }
    return redirect()->back();
    }
    
}
