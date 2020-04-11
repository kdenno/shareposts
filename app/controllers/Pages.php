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
    $data = [
      'title' => SITENAME,
      'description' => 'A simple social network built on top of DinoMVC framework'
    ];
    $this->loadView('pages/index', $data);
  }
  public function about()
  {
    $data = [
      'title' => 'About',
      'description' => 'A simple social network built on top of DinoMVC framework to for users to share posts wit other users'
    ];
    $this->loadView('pages/about', $data);
  }
}
