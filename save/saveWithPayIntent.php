<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/backend/models/Model.php'); 
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php'); 

use \Stripe\Stripe;
use \Stripe\Customer;
use \Stripe\PaymentIntent;
use \Stripe\PaymentMethod;
use \Stripe\Exception\CardException;

Stripe::setApiKey('sk_test_51Fw26JAr15mea9Q2aWUoWtLctCOhsZRrkZgcreOsloDi0l6WKuHoCIlZAwFrPxEecnVz6XvvuRdUqbFfqsq8KblQ00aKdZjRVs');


  class Payment extends Model {

    protected function getCustomer() {

      // session_start();
      // $userId = mysqli_escape_string($this->db, $_SESSION['userId']);

      // $sql = "SELECT * FROM users WHERE id = $userId";
      // $result = mysqli_query($this->db, $sql);
      // $user = mysqli_fetch_assoc($result);

      // mysqli_free_result($result);
      // mysqli_close($this->db);

      // if($user['stripe_customer_id'] == NULL) {

      //   $stripeCustomer = Customer::create([
      //     'email' => 'ayaneshsarkar101@gmail.com'
      //   ]);

      //   $stripeCustomerId = $stripeCustomer->id;

      //   $insertStripeCustomer = "UPDATE users SET stripe_customer_id = $stripeCustomerId WHERE id = $userId";
      //   mysqli_query($this->db, $insertStripeCustomer);

      //   return $stripeCustomer;

      // } else {

      //   $customerId = $user['stripe_customer_id'];


      // }

      return Customer::create([
        'email' => 'ayaneshsarkar101@gmail.com'
      ]);

      
    }

    public function intent() {

      session_start();
      $amount =  $_SESSION['amount'];

      return PaymentIntent::create([
        'amount' => $amount,
        'currency' => 'inr',
        'customer' => $this->getCustomer()->id
      ]);

    }

    protected function createPaymentMethod() {

      $payment = PaymentMethod::all([

        'customer' => $this->getCustomer(),
        'type' => 'card'

      ]);

      return $payment;

    }

    public function createPayment() {

      session_start();
      $amount =  $_SESSION['amount'];

      try {

        PaymentIntent::create([

          'amount' => $amount,
          'currency' => 'inr',
          'customer' => $this->getCustomer(),
          'payment_method' => $this->createPaymentMethod()->data,
          'off_session' => true,
          'confirm' => true
          
        ]);

      } catch(CardException $e) {
        echo 'Error code is:' . $e->getError()->code;
        $payment_intent_id = $e->getError()->payment_intent->id;
        $payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);
      }

    }

  }