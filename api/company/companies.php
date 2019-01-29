<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
  
  include_once '../../config/database.php';
  include_once '../../models/company.php';
  include_once '../../validations/company_form.php';

  $database = new Database();
  $conn = $database->getConnection();
  $company = new Company($conn);
  $data = json_decode(file_get_contents("php://input"));
  
  $errors = handleCompanyFormAttibuteErrors($data);

  if(!array_key_exists('amount', $data)) {
    array_push($errors, "Invoce amount cannot null");
  }

  if(count($errors) > 0) {
    echo json_encode(
      array('success' => false,
            'message' => $errors)
    );
  } else {
    $company->name = array_key_exists('name', $data) ? $data->name : '';
    $company->address = array_key_exists('address', $data) ? $data->address : '';
    $company->sector = array_key_exists('sector', $data) ? $data->sector : '';
    $company->tax_office = array_key_exists('tax_office', $data) ? $data->tax_office : '';
    $company->tax_number = array_key_exists('tax_number', $data) ? $data->tax_number : '';
    $company->representative_email = $data->representative_email;
    $company->representative_phone_number = $data->representative_phone_number;
    $company->representative_name = array_key_exists('representative_name', $data) ? $data->representative_name : '';
    $company->main_number = $data->main_number;
    $company->commitment_performance_period = $data->commitment_performance_period;
    $company->sub_numbers = $data->sub_numbers;
    $company->amount = $data->amount;
    
    if($company->create()) {
      echo json_encode(
        array('success' => true, 
              'message' => 'Phone numbers taken successfully')
      );
    } 
    else {
      echo json_encode(
        array('success' => false,
              'message' => 'Phone numbers could not taken')
      );
    }  
  }
?>  