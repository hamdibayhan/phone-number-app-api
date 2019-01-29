<?php
  include_once './config/database.php';

  function createTablesAndInsertData() {
    $database = new Database();
    $conn = $database->getConnection();

    if(!$conn) {
      echo "Error: Unable to open database\n";
    } else {
      echo "Opened database successfully\n";
      createCompanyTable($conn);
      createMainNumberTableAndInsertData($conn);
      createSubNumberTableAndInsertData($conn);
      createInvoceTable($conn);  
      pg_close($conn);
    }
  }

  function createCompanyTable($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS COMPANY
            (ID SERIAL PRIMARY KEY,
            NAME VARCHAR NOT NULL,
            ADDRESS TEXT,
            SECTOR VARCHAR,
            TAX_OFFICE VARCHAR,
            TAX_NUMBER VARCHAR,
            REPRESENTATIVE_EMAIL VARCHAR,
            REPRESENTATIVE_PHONE_NUMBER VARCHAR,
            REPRESENTATIVE_NAME VARCHAR,
            COMMITMENT_PERFORMANCE_PERIOD VARCHAR);";

    $ret = pg_query($conn, $sql);
    if(!$ret) {
    echo pg_last_error($conn);
    } else {
    echo "Company table created successfully\n";
    }
  }

  function createMainNumberTableAndInsertData($conn) {
    $sql ="CREATE TABLE IF NOT EXISTS MAIN_NUMBER
           (ID SERIAL PRIMARY KEY,
           COMPANY_ID INT REFERENCES company(id),
           NUMBER VARCHAR UNIQUE NOT NULL);
 
           INSERT INTO MAIN_NUMBER (number) 
           VALUES ('2001'), ('2002'), ('2003'), ('2004'), ('2005'), ('2006'), ('2007'), ('2008'), ('2009'), ('2010'),
                  ('2011'), ('2012'), ('2013'), ('2014'), ('2015'), ('2016'), ('2017'), ('2018'), ('2019'), ('2020')
           ON CONFLICT (number) DO NOTHING;";

    $ret = pg_query($conn, $sql);
    if(!$ret) {
      echo pg_last_error($conn);
    } else {
      echo "Main Number table created and Main Number records inserted successfully\n";
    }
  }

  function createSubNumberTableAndInsertData($conn) {
    $sql ="CREATE TABLE IF NOT EXISTS SUB_NUMBER
           (ID SERIAL PRIMARY KEY,
           COMPANY_ID INT REFERENCES company(id),
           NUMBER VARCHAR UNIQUE NOT NULL);

           INSERT INTO SUB_NUMBER (number) 
           VALUES ('1001'), ('1002'), ('1003'), ('1004'), ('1005'), ('1006'), ('1007'), ('1008'), ('1009'), ('1010'),
                  ('1011'), ('1012'), ('1013'), ('1014'), ('1015'), ('1016'), ('1017'), ('1018'), ('1019'), ('1020')
           ON CONFLICT (number) DO NOTHING;";

    $ret = pg_query($conn, $sql);
    if(!$ret) {
      echo pg_last_error($conn);
    } else {
      echo "Sub Number table created and Sub Number Records inserted successfully\n";
    }
  }

  function createInvoceTable($conn) {
    $sql ="CREATE TABLE IF NOT EXISTS INVOCE
           (ID SERIAL PRIMARY KEY,
           COMPANY_ID INT REFERENCES company(id),
           AMOUNT REAL NOT NULL,
           CREATED_AT TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP);";

    $ret = pg_query($conn, $sql);
    if(!$ret) {
        echo pg_last_error($conn);
    } else {
        echo "Invoce table created successfully\n";
    }
  }
?>