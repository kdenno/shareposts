<?php
class User {
  public function __construct()
  {
    $this->db = new Database;
  }
  public function checkEmail($email) {
    $query = "SELECT * FROM users WHERE email = :email";
    $this->db->query($query)->bind('email', $email)->getSingle();
    return $this->db->rowCount() > 0;
  }
}
