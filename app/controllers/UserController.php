<?php

class UserController extends BaseController {

  /**
   * Look up user by id and show profile page
   * @return View
   */
  public function showProfile($id)
  {
    /* If user with $id exits, show profile page, otherwise 404 */
    try {
      $user = Sentry::findUserById($id);


      /* Get images uploaded by user */
      $images = DB::table('images')->where('user_id', $id)->get();
      
      return View::make('profile')->with('user', $user)->with('images', $images);

    }
    catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
    {
      return App::abort(404);
    }

  }

  /**
   * List all users
   * @return View
   */
  public function listUsers()
  {
    try 
    {
      $users = Sentry::findAllUsers();
      return View::make('listusers')->with('users', $users);
    }
    catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
    {
      return App::abort(404);
    }

  }


  /**
   * Delete user with $id
   * @return View
   */
  public function deleteUser($id)
  {
    $admin = Sentry::getUser();

    /* Check that user is logged in and is admin */
    if($admin && $admin->hasAccess('admin'))
    {
      try {
        $user_to_delete = Sentry::findUserById($id);

        /* Can't delete admin users */
        if ($user_to_delete->hasAccess('admin'))
        {
          return Redirect::route('listusers')->withErrors('Can\'t delete admins');
        }
        else
        {
          $message = 'User '.$user_to_delete->first_name.' was deleted!';
          $user_to_delete->delete();
          return Redirect::route('listusers')->with('message', $message);
        }
      }
      catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
      {
        return App::abort(404);
      }
    }

  }


  /**
   * Edit user with $id
   * @return View
   */
  public function editUser($id)
  {
    echo var_dump(Input::all());
    $userdata = Input::all();

    $user = Sentry::findUserById($id);

    echo var_dump($id);

    /* Can't be arsed to write another validator for this so using same as registration */
    $userdata['password'] = $user->password;
    $userdata['password2'] = $user->password;

    /* Validate */
    if (User::validateUserData($userdata))
    {
      try
      {
        $user->first_name = $userdata['first_name'];
        $user->email = $userdata['email'];
        $user->description = $userdata['description'];

        $user->save();

        return Redirect::back();
      }
      catch(\Exception $e)
      {
        return Redirect::back()->withErrors($e->getMessage());
      }
    }
    else
    {
      return Redirect::back();
    }
  }

  /**
   * Show registration.
   * @return View
   */
  public function showRegistration()
  {
    /* If user is logged in, redirect to own profile */
    if (Sentry::check())
    {
      return Redirect::route('userprofile', Sentry::getUser()->id); 
    }
    else
    {
      return View::make('register'); 
    }

  }

  /**
   * Save new user to DB
   * @return View
   */
  public function saveUser()
  {
    $userdata = Input::all();

    /* Validate */
    if (User::validateUserData($userdata))
    {
      try
      {
        $userdata = array(
          'email' => $userdata['email'],
          'first_name' => $userdata['first_name'],
          'password' => $userdata['password'],
          'description' => $userdata['description'],
          'activated' => true, 
          );

        $user = Sentry::createUser($userdata);

        if ($user)
        {
          Sentry::login($user);
          return Redirect::route('/');
        }
      }
      catch(\Exception $e)
      {
        return Redirect::route('register')->withErrors(array('register' => $e->getMessage()));
      }
    }
    else
    {
      return Redirect::route('register');
    }

  }

  /**
   * Display the login page
   * @return View
   */
  public function showLogin()
  {
    return View::make('login');
  }

  /**
   * Login action
   * @return Redirect
   */
  public function doLogin()
  {
    $credentials = array(
      'email' => Input::get('email'),
      'password' => Input::get('password')
      );

    try
    {
      $user = Sentry::authenticate($credentials, false);

      if ($user)
      {
        return Redirect::intended('/');
      }
    }
    catch(\Exception $e)
    {
      return Redirect::route('login')->withErrors(array('login' => $e->getMessage()));
    }
  }

  /**
   * Logout action
   * @return Redirect
   */
  public function logout()
  {
    Sentry::logout();

    return Redirect::back();
  }

}