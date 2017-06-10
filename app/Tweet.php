<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Tweet extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function likedBy(){
        return $this->belongsToMany('App\User');
    }
    public function mentions(){
        $body = $this->body;
        $end=-1;
        for($i=0;$i<strlen($body);$i++){
            if($body{$i}=='@'){
                for($j=$i+1;$j<strlen($body);$j++){
                    if($body{$j}==' '){
                        $end = $j;
                        break;
                    }
                    else{
                        $end = $j;
                    }
                }
                $substr = substr($body,$i+1,$end);
                $user = User::where('name',$substr)->first();
                if($user==null)
                    continue;
                $replace = '<a href="/users/'.$user->id.'">'.$user->name.'</a> ';
                $body = str_replace ( '@'.$substr , $replace , $body);
            }
        }
        $this->attributes['body'] = $body;
    }   
}
