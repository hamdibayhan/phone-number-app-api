<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/database.php';
  include_once '../../models/main_number.php';

  $database = new Database();
  $conn = $database->getConnection();

  $main_number = new MainNumber($conn);
  $main_numbers = $main_number->getMainNumbers();
  
  if($main_numbers) {
    echo json_encode(
      array('success' => true, 
            'main_numbers' => $main_numbers)
    );
  } else {
    echo json_encode(
      array('success' => false, 
            'message' => 'Main numbers do not found')
    );
  }
?>  