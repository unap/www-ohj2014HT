@extends('layouts.master')

@section('main')

<div class="row">
  <div class="col-md-12">
    <h1>{{ Lang::get('messages.register') }}</h1>
  </div>
</div>

<div class="row">
  <div class="col-md-8">
    <!-- Show form -->
    <div id="register" class="register">
      {{ Form::open() }}
      <div class="control-group">
        {{ Form::label('email', Lang::get('messages.email')) }}
        <div class="controls">
          {{ Form::text('email') }}
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('first_name', Lang::get('messages.firstname')) }}
        <div class="controls">
          {{ Form::text('first_name') }}
        </div>
      </div>
      
      <div class="control-group">
        {{ Form::label('password', Lang::get('messages.password')) }}
        <div class="controls">
          {{ Form::password('password') }}
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('password2', Lang::get('messages.passwordagain')) }}
        <div class="controls">
          {{ Form::password('password2') }}
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('description', Lang::get('messages.description')) }}
        <div class="controls">
          {{ Form::textarea('description', '',array('onkeyup' => 'countChar(this, 255)')) }}
        </div>
         <div id="charnum"></div>
      </div>

      <hr>
      <div class="form-actions">
        {{ Form::submit(Lang::get('messages.register'), array('class' => 'btn btn-primary')) }}
      </div>
      
      {{ Form::close() }}
    </div>
  </div>
</div>

@include('partials.charcount')

@stop