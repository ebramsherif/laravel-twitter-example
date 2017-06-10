@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
@foreach($users as $user)
    <div class='user' user_id='{{$user->id}}'>
                <div class="panel panel-default">
                  <div class="panel-body">
                    <a href="/users/{{$user->id}}">{{$user->name}}</a>
                     @php($userM = App\User::find($user->id))
                     @if($user->id!=Auth::user()->id)
                        <a href="{{ '/follow/'.$user->id }}" style="position:sticky;left:100%;">
                        @if(!$userM->followers()->where('follower_id',Auth::user()->id)->exists())
                            Follow
                        @else
                            Unfollow
                        @endif
                        </a>
                    @endif
                  </div>
                </div>
            </div>
@endforeach
</div>
</div>
</div>
@endsection