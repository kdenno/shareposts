<?php
class Posts extends Controller {
  private $model;
  public function __construct()
  {
    // check if user is logged in
    if(!isLoggedIn()){
      redirect('users/login');
    }
    
  }
  public function index() {
    $data=[];
    $this->loadView('posts/index', $data);
  }
}
