<?php
class Post{
  private $db;
  
  public function __construct()
  {
    $this->db = new Database();
  }
  public function getPosts() {
    return $this->db->query('SELECT * FROM posts')->resultSet();
  }
}
