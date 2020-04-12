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
    $this->db->query($query)->bind(':email', $email)->getSingle();
    return $this->db->rowCount() > 0;
  }

  public function insertUser($data)
  {
    $query = 'INSERT INTO users(name, email, password) VALUES(:name, :email, :password)';
    return $this->db->query($query)->bind(':name', $data['name'])->bind(':email', $data['email'])->bind(':password', $data['password'])->execute();
  }

  public function checkPassword($data)
  {
    $query = "SELECT * FROM users WHERE email= :email";
    $row = $this->db->query($query)->bind(':email', $data['email'])->getSingle();
    if (password_verify($data['password'], $row->password)) {
      return $row;
    } else {
      return false;
    };
  }
}
