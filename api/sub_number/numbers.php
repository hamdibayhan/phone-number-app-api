<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/database.php';
  include_once '../../models/sub_number.php';

  $database = new Database();
  $conn = $database->getConnection();

  $sub_number = new SubNumber($conn);
  $sub_numbers = $sub_number->getSubNumbers();
  
  if($sub_numbers) {
    echo json_encode(
      array('success' => true, 
            'sub_numbers' => $sub_numbers)
    );
  } else {
    echo json_encode(
      array('success' => false, 
            'message' => 'Sub numbers do not found')
    );
  }
?>  