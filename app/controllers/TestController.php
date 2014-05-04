<?php

class TestController extends BaseController {

  public function image()
  {
    $image = new Image;
    $image->title = 'foo';
    $image->path = '01.jpg';
    $image->location = 'Helsinki';
    $image->points = 0;
    $image->user_id = 1;
    var_dump($image);
    $image->save();
  }

  public function resize()
  {
    echo "foo";
    Image::resize('img/lar.jpg');
  }


  public function user()
  {
    $user = Sentry::getUser();
    echo $user->getLocation();
  }

}
