@extends('layouts.master')

@section('main')

<div class="row">
  <div class="col-md-12">
    <h1>{{ Lang::get('messages.uploadimage') }}</h1>
  </div>
</div>
<div class="row">
  {{ Form::open(array('files' => true)) }}
  <div class="col-md-3">
    <div class="fileinput fileinput-new" data-provides="fileinput">
      <div class="fileinput-preview thumbnail" class="img-responsive">
        <img src="http://www.placehold.it/300/EFEFEF/AAAAAA&amp;text={{Lang::get('messages.noimage')}}">
      </div>
      <div>
        <span class="btn btn-default btn-file">
          <span class="fileinput-new">{{ Lang::get('messages.selectimage') }}</span>
          <span class="fileinput-exists">{{ Lang::get('messages.change') }}</span>
          {{ Form::file('image') }}
        </span>
        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">{{ Lang::get('messages.remove') }}</a>        
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="control-group">
      {{ Form::label('title', Lang::get('messages.title')) }}
      <div class="controls">
        {{ Form::text('title') }}
      </div>
    </div>
    <div class="control-group">
      {{ Form::label('description', Lang::get('messages.description')) }}
      <div class="controls">
        {{ Form::textarea('description', '',array('onkeyup' => 'countChar(this, 400)')) }}
        <div id="charnum"></div>
      </div>
    </div>
    <div class="control-group">
      <hr>
      {{ Form::submit(Lang::get('messages.upload'), array('class' => 'btn btn-primary fileinput-exists pull-right')) }}
    </div>
  </div>
  {{ Form::close() }}
</div>   

@include('partials.charcount')

@stop