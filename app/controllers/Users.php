<?php

class Users extends Controller {
  public function __construct()
  {
    
  }
  public function register() {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      // process form

    }else {
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

  public function login(){
    // Check for POST
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      // Process form
    } else {
      // Init data
      $data =[    
        'email' => '',
        'password' => '',
        'email_err' => '',
        'password_err' => '',        
      ];

      // Load view
      $this->loadView('users/login', $data);
    }
  }
}
