<?php
class Posts extends Controller {
  private $model;
  public function __construct()
  {
    $this->model = $this->model('Post');
    
  }
  public function index() {
    $data=[];
    $this->loadView('posts/index', $data);
  }
}
