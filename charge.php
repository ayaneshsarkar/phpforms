<?php 

  require_once './vendor/autoload.php';

  \Stripe\Stripe::setApiKey('sk_test_51Fw26JAr15mea9Q2aWUoWtLctCOhsZRrkZgcreOsloDi0l6WKuHoCIlZAwFrPxEecnVz6XvvuRdUqbFfqsq8KblQ00aKdZjRVs');

  $token = file_get_contents('php://input');
  $token = json_decode($token);
  
  $intent = \Stripe\PaymentIntent::create([

    'payment_method' => $token->token,
    'amount' => 700000,
    'currency' => 'inr',
    'confirmation_method' => 'manual', 
    'confirm' => true

  ]);

  function generatePaymentResponse($intent) {

    if($intent->status == 'requires_action' && $intent->next_action->type == 'use_stripe_sdk') {
      echo json_encode([
        'requires_action' => true,
        'payment_intent_client_secret' => $intent->client_secret
      ]);
    } elseif($intent->status == 'succeeded') {
      echo json_encode([
        'success' => true,
      ]);
    } else {
      http_response_code(500);
      echo json_encode([
        'error' => 'Invalid Payment Status'
      ]);
    }

  }

  generatePaymentResponse($intent);