
<?php

/**
 * PDO Database class
 * Connect to database
 * Bind values
 * Return rows and results
 */
class Database
{
  private $host = DB_HOST;
  private $user = DB_USER;
  private $password = DB_PASS;
  private $dbname = DB_NAME;

  private $dbh;
  private $error;
  private $stmt;

  public function __construct()
  {
    // set dsn
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
    $options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION

    );

    // create PDO intance
    try {
      $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      echo $this->error;
    }
  }
  public function query($query)
  {
    $this->stmt = $this->dbh->prepare($query);
    return $this;
  }

  public function bind($param, $value, $type = null)
  {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      };
      $this->stmt->bindValue($param, $value, $type);
    }
  }
  
  public function execute()
  {
    return $this->stmt->execute();
  }

  // get result set as array of objects 
  public function resultSet()
  {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }

  // get single record as object
  public function getSingle()
  {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
  }

  // get row count 
  public function rowCount()
  {
    return $this->stmt->rowCount();
  }
}
?>