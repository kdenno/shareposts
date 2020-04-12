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
  public function add()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'title' => $_POST['title'],
        'body' => $_POST['body'],
        'userId' => $_SESSION['user_id'],
        'title_err' => '',
        'body_err' => ''
      ];
      // validate title
      if (empty($data['title'])) {
        $data['title_err'] = 'Please Enter Title';
      }
      // validate body
      if (empty($data['body'])) {
        $data['body_err'] = 'Please Enter Post Content';
      }

      // make sure no errors
      if (empty($data['title_err']) && empty($data['body_err'])) {
        if ($this->postModel->insertPost($data)) {
          redirect('posts');
        } else {
          die('Error occured while insertind data');
        }
      } else {
        // reload view with errors
        $this->loadView('posts/add', $data);
      }
    } else {
      $data = ['title' => '', 'body' => ''];
      $this->loadView('posts/add', $data);
    }
  }
}
