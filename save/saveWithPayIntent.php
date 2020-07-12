<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php'); 

use \Stripe\Stripe;
use \Stripe\Customer;
use \Stripe\PaymentIntent;
use \Stripe\PaymentMethod;
use \Stripe\Exception\CardException;

Stripe::setApiKey('sk_test_51Fw26JAr15mea9Q2aWUoWtLctCOhsZRrkZgcreOsloDi0l6WKuHoCIlZAwFrPxEecnVz6XvvuRdUqbFfqsq8KblQ00aKdZjRVs');


  class Payment {

    protected function getCustomer() {
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