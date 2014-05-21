@extends('layouts.master')

@section('main')

<div class="row">
  <div class="col-md-12">
    <h1>{{ Lang::get('messages.welcome') }}</h1>
  </div>
</div>
<div class="row">

  <div class="col-md-3 col-md-push-9">
    <div class="panel panel-default">
      <div class="panel-body">
        <h4>{{ Lang::get('messages.info') }}</h4>
        {{ Lang::get('messages.websiteinfo') }}
      </div>
    </div>
  </div>

  <div class="col-md-9 col-md-pull-3">
    <div class="panel panel-default">
      <div id="tabs" class="panel-body">

        <ul>
          <li><a href="#date">{{ Lang::get('messages.dateorder') }}</a></li>
          <li><a href="#points">{{ Lang::get('messages.pointsorder') }}</a></li>
        </ul>

        <div id="date">
          <?php $images = $images->sortBy('created_at') ?>
          @include('partials.imagelist')
        </div>
        <div id="points">
          <?php $images = $images->sortBy(function($image){return -($image->points);}) ?>
          @include('partials.imagelist')
        </div>

      </div>
    </div>
  </div>
</div>

@stop