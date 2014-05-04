<?php namespace App\Facades;

/* Code from http://creolab.hr/2013/07/image-manipulation-in-laravel-4-with-imagine/ */

use Illuminate\Support\Facades\Facade;

class ImageFacade extends Facade {
 
  protected static function getFacadeAccessor()
  {
    return new \App\Services\Image;
  }
  
}