<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../models/invoce.php';
  include_once '../../config/environments.php';
  include_once '../../validations/company_form.php';

  $invoce = new Invoce();
  $data = json_decode(file_get_contents("php://input"));
  $errors = handleCompanyFormAttibuteErrors($data);

  if(count($errors) > 0) {
    echo json_encode(
      array('success' => false, 
            'message' => $errors)
    );
  } else {
    $invoce->commitment_performance_period = $data->commitment_performance_period;
    $invoce->sub_numbers = $data->sub_numbers;

    $amount = $invoce->calculateInvoceAmount();

    if($amount) {
      echo json_encode(
        array('success' => true,
              'amount' => $amount,
              'message' => 'Invoce amount calculated successfully')
      );
    } else {
      echo json_encode(
        array('success' => false,
              'message' => 'Invoce amount not calculated')
      );
    }
  }
?>  