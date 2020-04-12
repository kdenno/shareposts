<?php

class Users extends Controller
{
  public function __construct()
  {
    $this->userModel = $this->model('User');
  }
  public function register()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      // process form
      $data = [
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'confirm_password' => trim($_POST['confirm_password']),
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];
      if (empty($data['name'])) {
        $data['name_err'] = 'Please enter name';
      } else {
        // check if email already exists
        if ($this->userModel->checkEmail($data['email'])) {
          $data['email_err'] = 'Email already exists';
        }
      }
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter Email';
      }
      if (empty($data['password'])) {
        $data['password_err'] = 'Please enter password';
      }
      if (empty($data['confirm_password'])) {
        $data['confirm_password_err'] = 'Please enter data';
      } else {
        if ($data['password'] != $data['confirm_password']) {
          $data['confirm_password_err'] = 'Password miss-match';
        }
      }

      if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
        // hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        // insert user 
        if ($this->userModel->insertUser($data)) {
          // redirect to login
          redirect('users/login');
        } else {
          die('Error Occured');
        }
      } else {
        // re-render page with errors
        $this->loadView('users/register', $data);
      }
    } else {
      $data = [
        'name' => '',
        'email' => '',
        'password' => '',
        'confirm_password' => '',
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];
      // load view
      $this->loadView('users/register', $data);
    }
  }

  public function login()
  {
    // Check for POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Process form
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      // Init data
      $data = [
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'email_err' => '',
        'password_err' => '',
      ];

      // Validate Email
      if (empty($data['email'])) {
        $data['email_err'] = 'Pleae enter email';
      } elseif (!$this->userModel->checkEmail($data['email'])) {
        $data['email_err'] = 'User does not exist';
      }

      // Validate Password
      if (empty($data['password'])) {
        $data['password_err'] = 'Please enter password';
      }


      // Make sure errors are empty
      if (empty($data['email_err']) && empty($data['password_err'])) {
        $loggedInUser = $this->userModel->checkPassword($data);
        if ($loggedInUser) {
          $this->LoginUser($loggedInUser);
        } else {
          $data['password_err'] = 'Wrong Password';
          $this->loadView('users/login', $data);
        }
      } else {
        // Load view with errors
        $this->loadView('users/login', $data);
      }
    } else {
      // Init data
      $data = [
        'email' => '',
        'password' => '',
        'email_err' => '',
        'password_err' => '',
      ];

      // Load view
      $this->loadView('users/login', $data);
    }
  }

  public function LoginUser($user)
  {
    $data = [
      'user_id'=> $user->id,
      'user_name'=> $user->name,
      'user_email'=> $user->email,
    ];
   createSession($data);
   redirect('pages/index');
  }

  public function logOut() {
    $data = [ 'user_id','user_name','user_email',];
   destroySession($data);
   redirect('pages/index');
  }

  public function isLoggedIn() {
   return isset($_SESSION['user_id']);
  }
}
