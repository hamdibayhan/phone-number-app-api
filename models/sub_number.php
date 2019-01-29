<?php
  class SubNumber {
    // DB Properties
    private $conn;
    private $table = 'sub_number';

    public function __construct($db) {
      $this->conn = $db;
    }

    public function getSubNumbers() {
      $qry = "SELECT * from $this->table WHERE company_id IS NULL";
      $result = pg_query($this->conn, $qry);

      if($result) {
        while ($row = pg_fetch_row($result)) {
          $numbers[] = $row[2];
        }
        return $numbers;
      }
      return false;
    }
  }
?>