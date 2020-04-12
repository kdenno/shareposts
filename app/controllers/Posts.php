<?php
class Posts extends Controller
{
  private $postModel;
  public function __construct()
  {

    // check if user is logged in
    if (!isLoggedIn()) {
      redirect('users/login');
    }

    // get access to the model
    $this->postModel = $this->model('Post');
  }
  public function index()
  {
    $posts = $this->postModel->getPosts();
    $data = [
      'title' => 'Posts',
      'posts' => $posts
    ];
    $this->loadView('posts/index', $data);
  }
}
