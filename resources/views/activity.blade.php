@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Likes</div>
                        <div class="panel-body">
                            @foreach($likes as $like)
                             <div class="panel panel-default">
                                <div class="panel-heading"><b>{{App\User::find($like->user_id)->name}}</b> likes</div>
                             <div class="panel-body">
                                 @php($username = App\User::find(App\Tweet::find($like->tweet_id)->user_id)->name)
                                <span style="padding-right:3px;"><b>{!! '@'.$username !!}</b></span>
                                <br>
                                @php($tweetM = App\Tweet::find($like->tweet_id))
                                @php($tweetM->mentions())
                                {!! $tweetM->body !!}
                                <br>
                                {{$tweetM->created_at}} <span  style="position:sticky;left:100%;">
                                    <a href="{{ '/tweets/like/'.$tweetM->id }}">
                                    @if(!$tweetM->likedBy()->where('user_id',Auth::user()->id)->exists())
                                        Like
                                    @else
                                        Unlike
                                    @endif
                                    </a>
                                    @if($tweetM->user_id==Auth::user()->id)
                                    <a href="{{ '/tweets/delete/'.$tweetM->id }}">Delete</a></span>
                                    @endif
                             </div>
                        </div>
                    </div>
                </div>
              @endforeach
              <div class="panel panel-default">
                    <div class="panel-heading">Follows</div>
                        <div class="panel-body">
                            @foreach($follows as $follow)
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <b>{{App\User::find($follow->follower_id)->name}}</b> followed <b>{{App\User::find($follow->followed_id)->name}}</b>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection