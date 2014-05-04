<?php

class Comment extends \Eloquent {
 
  protected $table = 'comments';

  protected $fillable = array('image_id', 'user_id', 'body' );

  /**
   * Validate comment
   *
   * @return boolean
   */
  public static function validateComment($input)
  {
    /* rules for validator */
    $rules = array(
      'user_id' => 'required',
      'image_id' => 'required',
      'body' => 'max:140',
      );

    $validator = Validator::make(
      $input,
      $rules
      );

    if ($validator->passes())
    {
      return true;
    }
    else
    {
      Session::flash('errors', $validator->messages());
      return false;
    }
  }

  public function author()
  {
    return $this->belongsTo('User');
  }
  
}