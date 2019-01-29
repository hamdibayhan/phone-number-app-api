<?php
  include_once '../../config/constants.php';

  class Invoce {
    // Properties
    public $commitment_performance_period;
    public $sub_numbers;

    public function calculateInvoceAmount() {
      $amount = 0;
      $number_mountly_price = $this->getMontlyPrice();
      $sub_numbers_count = count($this->sub_numbers);
      
      if ($sub_numbers_count > $_ENV["LIMIT_FOR_DISCOUNT"]) {
        $discounted_amount = ($sub_numbers_count - $_ENV["LIMIT_FOR_DISCOUNT"]) * $number_mountly_price * $_ENV["DISCOUNT_RATE"];
        $standard_amount = $_ENV["LIMIT_FOR_DISCOUNT"] * $number_mountly_price;
        $amount = $discounted_amount + $standard_amount;
      } else {
        $amount = $number_mountly_price * $sub_numbers_count;
      }

      return $amount;
    }

    private function getMontlyPrice() {
      switch ($this->commitment_performance_period) {
        case "1_yearly":
          return $_ENV["1_YEARLY_PRICE"];
        case "2_yearly":
          return $_ENV["2_YEARLY_PRICE"];
        case "3_yearly":
          return $_ENV["3_YEARLY_PRICE"];
        default:
          return $_ENV["DEFAULT_PRICE"];
      }
    }
  }
?>