<?php 

  require_once './vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51Fw26JAr15mea9Q2aWUoWtLctCOhsZRrkZgcreOsloDi0l6WKuHoCIlZAwFrPxEecnVz6XvvuRdUqbFfqsq8KblQ00aKdZjRVs');

$intent = \Stripe\PaymentIntent::create([
  'amount' => 1000,
  'currency' => 'inr',
  // Verify your integration in this guide by including this parameter
  'metadata' => ['integration_check' => 'accept_a_payment'],
]);