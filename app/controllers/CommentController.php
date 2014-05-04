<?php

class CommentController extends BaseController {

  /**
   * Save comment
   *
   * @return Redirect
   */
  public function saveComment($image_id)
  {
    $attributes = array(
      'user_id' => Sentry::getUser()->id,
      'image_id' => $image_id,
      'body' => Input::get('comment'),
      );

    /* Validate */
    if (Comment::validateComment($attributes))
    {
      $comment = new Comment($attributes);
      $comment->save();
    }

    return Redirect::route('image', $image_id);


  }

  

}