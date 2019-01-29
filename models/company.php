<?php
  class Company {
    // DB Properties
    private $conn;
    private $table = 'company';
    // Properties
    public $name;
    public $address;
    public $sector;
    public $tax_office;
    public $tax_number;
    public $representative_email;
    public $representative_phone_number;
    public $representative_name;
    public $commitment_performance_period ;
    public $main_number;
    public $sub_numbers;
    public $amount;

    public function __construct($db) {
      $this->conn = $db;
    }

    public function create() {
      $company_qry = "INSERT INTO
                     $this->table
                     (name, address, sector, tax_office, tax_number, representative_email, representative_phone_number, representative_name, commitment_performance_period)
                     values('$this->name', '$this->address', '$this->sector', '$this->tax_office', '$this->tax_number', '$this->representative_email',
                            '$this->representative_phone_number', '$this->representative_name', '$this->commitment_performance_period') RETURNING id";

      $company_result = pg_query($this->conn, $company_qry);

      if($company_result) {
        $company_id = $this->getCompanyId($company_result);

        if($this->assignCompanyIdToNumbers($company_id)) {
          if($this->createInvoce($company_id)) {
            return true;
          }
        }
      }
      return false;
    }

    private function getCompanyId($company_result) {
      $company_result_row = pg_fetch_row($company_result);

      return $company_result_row[0];
    }

    private function assignCompanyIdToNumbers($company_id) {
      $sub_numbers = "'". implode("','", $this->sub_numbers) . "'";
      $qry = "BEGIN; 
              UPDATE MAIN_NUMBER SET company_id=$company_id WHERE number='$this->main_number';
              UPDATE SUB_NUMBER SET company_id=$company_id WHERE number IN($sub_numbers);
              COMMIT;";

      if(pg_query($this->conn, $qry)) {
        return true;
      }
      return false;
    }

    private function createInvoce($company_id) {
      $qry = "INSERT INTO invoce (company_id, amount) values($company_id, $this->amount)";
      pg_query($this->conn, $qry);

      return true;
    }
  }
?>