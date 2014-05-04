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
    @include('partials.imagelist')
  </div>
</div>

<div class="row">
  <div class="col-md-6 col-md-offset-3 paginatelinks">
    {{ $images->links() }}
  </div>
</div>


@stop