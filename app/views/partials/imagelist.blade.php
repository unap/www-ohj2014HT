@foreach ($images as $image)
  <div class="col-sm-3 col-xs-6">
    <a href="{{ URL::route('image', $image->id) }}" class="thumbnail">
      <img src="{{ asset('img/'.explode('.', $image->path)[0].'_thumb.'.explode('.', $image->path)[1]) }}" />
    </a>
  </div>
@endforeach