@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
    <h1>{{$user->name}}</h1>
         @include('partials.tweets',['tweets'=>$tweets])
        </div>
    </div>
</div>
@endsection