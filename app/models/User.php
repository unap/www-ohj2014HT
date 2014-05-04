<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Cartalyst\Sentry\Users\Eloquent\User implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

  /**
   * Get users location
   *
   * @return String
   */
  public function getLocation()
  {
    return $this->location;
  }

  public function delete()
  {
    // delete all related images and comments 
    Comment::where("user_id", $this->id)->delete();
    Post::where("user_id", $this->id)->delete();

    // delete the user
    return parent::delete();
  }

  /**
   * Validate user registration data
   *
   * @return boolean
   */
  public static function validateUserdata($input)
  {

    /* rules for validator */
    $rules = array(
      'email' => 'required|email',
      'first_name' => 'required|alpha_num',
      'password' => 'required|min:8',
      'password2' => 'required|same:password',
      'description' => 'max:255'
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

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}
