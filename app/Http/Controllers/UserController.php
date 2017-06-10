<?php 
namespace App\Http\Controllers;
use App\User;
use App\Tweet;
use Auth;
use DB;
class UserController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    public function follow($id){
        $user_id = Auth::user()->id;
        if($id==$user_id)
            return redirect()->action(
            'UserController@show', ['id' => $id])->with('alert','You cannot follow yourself');
        $to_follow_id = User::find($id);
        if((!DB::table('user_user')->where([
        ['follower_id', '=', $user_id], ['followed_id', '=', $id],])
        ->exists())&&(Auth::user()->id!=$id)){
            $to_follow_id->followers()->attach($user_id);
            return redirect()->action(
            'UserController@show', ['id' => $id])->with('status','You are now following '.$to_follow_id->name);
        } 
        else{
            $to_follow_id->followers()->detach($user_id);
            return redirect()->action(
            'UserController@show', ['id' => $id])->with('alert','You unfollowed '.$to_follow_id->name);
        }
    }
    public function show($id){
        $user = User::find($id);
        $tweets = Tweet::where('user_id',$id)->get();
        return view('users/show',['user'=>$user,'tweets'=>$tweets]);
    }
}