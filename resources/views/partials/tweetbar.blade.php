<div class="panel panel-default">
                <div class="panel-heading">Tweet</div>
                <div class="panel-body">
                {!! Form::open(['action' => 'TweetController@create']) !!}
                {!! Form::text('body',null,['style' => 'width:93%;']) !!}
                {!! Form::submit('Tweet!') !!}
                {!! Form::close() !!}  
                </div>
</div>