@extends('layouts.master')

@section('main')

<?php /*current user*/$cur_user = Sentry::getUser() ?>

<div class="row">
  <div class="col-md-12">
    <h1>{{ Lang::get('messages.userprofileof', array('name' => $user->first_name)) }}</h1>
  </div>
</div>
<div class="row">

  <div class="col-md-3 col-md-push-9">
    <div class="panel panel-default">
      <div class="panel-body">
        {{{ $user->email }}}
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-body">
        {{ $user->description }}
        
        @if($cur_user && ($cur_user->id == $user->id | $cur_user->hasAccess('admin')))
        <!-- User can edit own information. Admin can edit everyone's information -->
          <hr>
          <a data-target="#edit" role="button" class="btn btn-default" data-toggle="modal">{{ Lang::get('messages.edit')}}</a>
        @endif
      </div>
    </div>
  </div>

  <div class="col-md-9 col-md-pull-3">
    @include('partials.imagelist')
  </div>
</div>

@if($cur_user && ($cur_user->id == $user->id | $cur_user->hasAccess('admin')))
<!-- Hidden modal for editing user information -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="editLabel">{{ Lang::get('messages.edit')}}</h4>
      </div>
      {{ Form::model($user) }}
      <div class="modal-body">
        <div class="control-group">
          {{ Form::label('first_name', Lang::get('messages.firstname')) }}
          <div class="controls">
            {{ Form::text('first_name') }}
          </div>
        </div>
        <div class="control-group">
          {{ Form::label('email', Lang::get('messages.email')) }}
          <div class="controls">
            {{ Form::text('email') }}
          </div>
        </div>
        <hr>
        @include('partials.wysihtmltoolbar')

        {{ Form::textarea('description', $user->description,array('id' => 'description', 'style' => 'width:100%;')) }}

        <!-- <form><textarea id="wysihtml5-textarea" >{{ $user->description }}</textarea></form> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('messages.close')}}</button>
        {{ Form::submit(Lang::get('messages.edit'), array('class' => 'btn btn-primary')) }}
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
@endif

{{ HTML::script('js/wysihtml5/parser_rules/advanced.js') }}
{{ HTML::script('js/wysihtml5/dist/wysihtml5-0.3.0.min.js') }}

<script>
  var editor = new wysihtml5.Editor("description", { // id of textarea element
    toolbar:      "wysihtml5-toolbar", // id of toolbar element
    parserRules:  wysihtml5ParserRules // defined in parser rules set 
  }); 
</script>


@stop
