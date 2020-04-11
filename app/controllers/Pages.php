<?php
class Pages extends Controller
{
  private $postModel;
  public function __construct()
  {
    $this->postModel = $this->model('Post');
  }
  public function index()
  {
    // since index is the default method 
    $posts = $this->postModel->getPosts();
    $data = ['title' => SITENAME];
    $this->loadView('pages/index', $data);
  }
  public function about()
  {
    $this->loadView('pages/about');
  }
}
