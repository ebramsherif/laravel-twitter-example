@foreach ($tweets as $tweet)
            <div class='tweet' tweetid='{{$tweet->id}}'>
                <div class="panel panel-default">
                  <div class="panel-body">
                    @php($username = App\User::find($tweet->user_id)->name)
                    <span style="padding-right:3px;"><b>{!! '@'.$username !!}</b></span>
                    <br>
                    @php($tweetM = App\Tweet::find($tweet->id))
                    @php($tweetM->mentions())
                    {!! $tweetM->body !!}
                    <br>
                    {{$tweet->created_at}} <span  style="position:sticky;left:100%;">
                        <a href="{{ '/tweets/like/'.$tweet->id }}">
                        @if(!$tweetM->likedBy()->where('user_id',Auth::user()->id)->exists())
                            Like
                        @else
                            Unlike
                        @endif
                        </a>
                        @if($tweet->user_id==Auth::user()->id)
                        <a href="{{ '/tweets/delete/'.$tweet->id }}">Delete</a></span>
                        @endif
                  </div>
                </div>
            </div>
@endforeach