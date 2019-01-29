<?php
  require_once '../../vendor/autoload.php';
  use Twilio\Rest\Client;

  function handleCompanyFormAttibuteErrors($data) {
    $errors=[];

    if(!array_key_exists('main_number', $data)) {
      array_push($errors, "You must select one main number");
    }

    if(!array_key_exists('sub_numbers', $data)) {
      array_push($errors, "You must select least one sub number");
    }

    if(!array_key_exists('commitment_performance_period', $data)) {
      array_push($errors, "You must select commitment performance period");
    }

    if(array_key_exists('representative_email', $data)) {
      if(!isValidEmail($data->representative_email)) {
        array_push($errors, "Your email address is not valid, please enter a valid number");
      }
    } else {
      array_push($errors, "You must enter representative email");
    }

    if(array_key_exists('representative_phone_number', $data)) {
      if(!isValidPhoneNumber($data->representative_phone_number)) {
        array_push($errors, "Your phone number is not valid, please enter a valid number");
      }
    } else {
      array_push($errors, "You must enter representative phone number");
    }

    return $errors;
  }

  function isValidEmail($email) {
    return preg_match('/\A[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}\z/', $email)
        && preg_match('/^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/', $email);
  }

  function isValidPhoneNumber($phone_number) {
    // Find your Account Sid and Auth Token at twilio.com/console
    $sid    = $_ENV["TWILIO_SID"];
    $token  = $_ENV["TWILIO_SID_TOKEN"];
    $twilio = new Client($sid, $token);

    try {
      $twilio->lookups->v1->phoneNumbers($phone_number)
                          ->fetch(array("type" => "carrier"));
      return true;
    }
    catch(Exception $e) {
      return false;
    }
  }
?>  