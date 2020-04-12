<?php
class Post
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }
  public function getPosts()
  {
    return $this->db->query('SELECT *,
                            posts.id as postId,
                            users.id as userId,
                            posts.created_at as postCreated,
                            users.created_At as userCreated
                            FROM posts
                            INNER JOIN users
                            ON posts.user_id = users.id
                            ORDER BY posts.created_at DESC')->resultSet();
  }
  public function insertPost($data)
  {
    $query = 'INSERT INTO posts(user_id, title, body) VALUES(:user_id, :title, :body)';
    return $this->db->query($query)->bind(':user_id', $data['userId'])->bind(':title', $data['title'])->bind(':body', $data['body'])->execute();
  }
  public function getPostById($id)
  {
    $query = "SELECT * FROM posts WHERE id = :id";
    return $this->db->query($query)->bind(':id', $id)->getSingle();
  }
  public function updatePost($data)
  {
    $query = 'UPDATE posts SET title = :title, body = :body WHERE id = :id';
    return $this->db->query($query)->bind(':id', $data['id'])->bind(':title', $data['title'])->bind(':body', $data['body'])->execute();
  }
  public function deletePost($id)
  {
    $query = "DELETE FROM posts WHERE id=:id";
    return $this->db->query($query)->bind(':id', $id)->execute();
  }
}
