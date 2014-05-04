@extends('layouts.master')

@section('main')

<div class="row">
  <div class="col-md-12">
    <h1>{{{ $image->title }}}</h1>
    <?php $user = Sentry::findUserById($image->user_id) ?>
    <h4>{{ Lang::get('messages.uploader')}}: <a href="{{URL::route('userprofile', $user->id)}}">{{ $user->first_name}}</a></h4>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="well centered">
      <a href="{{ asset('img/'.$image->path) }}" class="fancybox">
        <img class="imgpost" src="{{ asset('img/'.$image->path) }}" />
      </a>
      <h4>Points: <span id="points">{{ $image->points }}</span></h4>
      @if(Sentry::check())
      <!-- Voting -->
      <a class="btn btn-success" href="#" onclick="sendVote('up');return false;">
        <span class="glyphicon glyphicon-arrow-up"></span>
      </a>
      <a class="btn btn-danger" href="#" onclick="sendVote('down');return false;">
        <span class="glyphicon glyphicon-arrow-down"></span>
      </a>
      @endif


    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="well centered">{{{ $image->description }}}</div>
  </div>
</div>

<!-- Logged users can comment -->
@if(Sentry::check())
<div class="row">
  <div class="col-md-12">
    <div id="commentform" class="well">
      {{ Form::open() }}
      <div class="control-group">
        {{ Form::label('comment', Lang::get('messages.comment')) }}
        <div class="controls">
          {{ Form::textarea('comment', '',array('onkeyup' => 'countChar(this, 140)')) }}
        </div>
      </div>
      <div class="control-group">
        <div id="charnum"></div>
        <br>
        <div class="form-actions">
          {{ Form::submit(Lang::get('messages.sendcomment'), array('class' => 'btn btn-primary pull-right')) }}
        </div>
        <div class="clearfix"></div>
      </div>
      
      {{ Form::close() }}
    </div>
  </div>
</div>
@endif


@foreach(Comment::where('image_id', $image->id)->get() as $comment)
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <?php $user = Sentry::findUserById($comment->user_id); ?>
        <h3 class="panel-title">
          <a href="{{URL::route('userprofile', $user->id)}}"> {{{ $user->first_name }}}</a>:<span class="comment-points">
          </span></h3>
        <div class="clearfix"></div>
      </div>
      <div class="panel-body">
        {{{ $comment->body }}}
      </div>
      <div class="panel-footer">{{ $comment->created_at }}</div>
    </div>
  </div>
</div>
@endforeach

@include('partials.charcount')

@if(Sentry::check())
<script>
  function sendVote (vote) {
    $.post(
      "{{ URL::route('imagevote', $image->id)}}",
      {
        "_token": $('input[name=_token]' ).val(),
        "vote": vote
      },
      function( data ) {
        //Update points on response
        $('#points').text(data.points);
      },
      'json'
    );
  }
</script>
@endif



@stop