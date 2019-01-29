<?php
  include 'environments.php';

  Class Database{
    var $conn;

    function getConnection() {
      $host        = $_ENV["HOST"];
      $port        = $_ENV["PORT"];
      $dbname      = $_ENV["DB_NAME"];
      $credentials = $_ENV["CREDENTIALS"];

      $con = pg_connect("$host $port $dbname $credentials");

      if(!$con) {
        echo "Error: Unable to open database\n";
      } else {
        $this->conn = $con;
      }

      return $this->conn;
    }
  }
?>