@extends('layouts.master')

@section('main')


<h1>{{ Lang::get('messages.login') }}</h1>


<div id="login" class="login">
  {{ Form::open() }}
  
  <div class="control-group">
    {{ Form::label('email', Lang::get('messages.email')) }}
    <div class="controls">
      {{ Form::text('email') }}
    </div>
  </div>
  
  <div class="control-group">
    {{ Form::label('password', Lang::get('messages.password')) }}
    <div class="controls">
      {{ Form::password('password') }}
    </div>
  </div>
  <hr>
  <div class="form-actions">
    {{ Form::submit(Lang::get('messages.login'), array('class' => 'btn btn-primary')) }}
  </div>
  
  {{ Form::close() }}
</div>

@stop