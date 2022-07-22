<?php
include_once('constants.php');
class Database{
private $conn;
public function connect()
{
    // $this->conn = null;
  $this->conn = new mysqli(HOST,USER,PASSWORD,DB);
  IF($this->conn){
    return $this->conn;
  }
 return "DATABASE_CONNECTION_FAIL";
}

}
?>