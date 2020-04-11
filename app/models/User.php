<?php
class User
{
  public function __construct()
  {
    $this->db = new Database;
  }
  public function checkEmail($email)
  {
    $query = "SELECT * FROM users WHERE email = :email";
    $this->db->query($query)->bind('email', $email)->getSingle();
    return $this->db->rowCount() > 0;
  }

  public function insertUser($data)
  {
    $query = 'INSERT INTO users(name, email, password) VALUES(:name, :email, :password)';
    return $this->db->query($query)->bind('name', $data['name'])->bind('email', $data['email'])->bind('password', $data['password'])->execute();
  }
}
