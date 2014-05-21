<?php

class HomeController extends BaseController {

  /**
   * Show listing of all images
   *
   * @return View
   */
	public function showHome()
	{
    $images = Post::all();
		return View::make('home')->with('images', $images);
	}

}
