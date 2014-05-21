<?php

class PostController extends BaseController {

  /**
   * Show upload page.
   * @return View
   */
  public function showUploadPage()
  {
    return View::make('upload');
  }

  /**
   * Show image with $id.
   * @return View
   */
  public function showImagePage($id)
  {
    $image = Post::find($id);
    return View::make('post')->with('image', $image);
  }

  /**
   * Save new image.
   * @return View
   */
  public function saveImage()
  {
    /* Validate */
    if (Post::validateUpload(Input::all()))
    {

      $image = Input::file('image');

      // generate random filename
      $filename = str_random(9).'.'.$image->getClientOriginalExtension();

      $attributes = array(
        'path' => $filename,
        'title' => Input::get('title'),
        'description' => Input::get('description'),
        'user_id' =>Sentry::getUser()->id,
        );
      
      // make the post
      $post = new Post($attributes, $image);

      // go to the post
      return Redirect::route('image', $post->id);      
    }
    else 
    {
      return Redirect::route('upload');
    }
  }

  /**
   * Vote on image.
   * @return 
   */
  public function vote($id)
  {    
    //check token
    if ( Session::token() !== Input::get( '_token' ) ) 
    {
      return Response::json(array('msg' => 'Unauthorized attempt to vote'));
    }
    else 
    {
      $vote = Input::get( 'vote' );

      switch ($vote) {
        case 'up': 
          $val = 1;
          break;
        case 'down': 
          $val = -1;
          break;
        default: 
          $val = 0;
      }

      $image = Post::find($id);
      $image->points = $image->points+$val;
      $image->save();

      return Response::json(array('points' => $image->points));

    }

  }

  /**
   * Delete image with $id
   * @return Redirect
   */
  public function deleteImage($id)
  {
    $image_to_delete = Post::find($id);

    $user = Sentry::getUser();
    $uploader = Sentry::findUserById($image_to_delete->user_id);

    /* Check that user is logged in and is uploader or admin */
    if($user && ($user->hasAccess('admin')) || $user == $uploader)
    {

      $message = 'Image '.$image_to_delete->title.' was deleted!';
      $image_to_delete->delete();
      return Redirect::route('/')->with('message', $message);
    }
    else
    {
      $message = 'Authorization required to delete image!';
      return Redirect::back()->withErrors($message);
    }

  }


}
