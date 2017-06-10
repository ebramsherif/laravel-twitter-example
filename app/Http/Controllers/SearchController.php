<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tweet;
use App\User;
use Auth;
use DB;

class SearchController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function searchUsers(Request $request){
        $search = $request->input('input');
        $users = User::where('name', 'LIKE', '%'.$search.'%')->get();
        return view('search',['users'=>$users]); 
    }
}
