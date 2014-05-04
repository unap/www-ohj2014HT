<?php

/*
 * Calling the imageposts just posts to avoid confusion with Image
 */

class Post extends \Eloquent {

  protected $fillable = array('path', 'title', 'description', 'user_id' );
 
  protected $table = 'images';

  public function __construct($attributes = array(), $image = NULL)  {
    parent::__construct($attributes); // Eloquent

    if ($image)
    {
      $target_path = Config::get('image.upload_path');

      $filename = $this->path;
      // save file to directory
      $upload = $image->move($target_path, $filename);

      // check if upload was successful
      if ($upload) {
        // save thumbnail
        $thumb = Image::resize('/img/'.$filename);
        $this->save();
      }
      else {
        Session::flash('errors', 'Upload failed');
      }
      
    }
  }

  /**
   * Validate uploaded image
   *
   * @return boolean
   */
  public static function validateUpload($input)
  {

    /* rules for validator */
    $rules = array(
      'title' => 'required',
      'image' => 'required|mimes:jpeg,png,gif',
      'description' => 'max:140',
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

  public function user()
  {
    return $this->belongsTo('User');
  }
  
}