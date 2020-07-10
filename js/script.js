var stripe = Stripe('pk_test_QHQBHEgp054jPyeOIOik1DDW00Q1SiFQQO');
var elements = stripe.elements();


var response = fetch('../secret.php', {
  headers : { 
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  }
})
.then(function(response) {
  return response.json();
})
.then(function(responseJson) {
  clientSecret = responseJson.client_secret;
  // Call stripe.confirmCardPayment() with the client secret.
});


// Set up Stripe.js and Elements to use in checkout form
var style = {
  base: {
    color: "#212121",
    fontSize: "16px",
    fontFamily: 'inherit',
    fontWeight: '400',

    '::placeholder': {
      color: '#757575',
      fontFamily: 'inherit',
      fontWeight: '400'
    }
  }
};

var card = elements.create("card", { style: style });
card.mount("#card-element");

card.on('change', ({error}) => {
  const displayError = document.getElementById('card-errors');
  if (error) {
    displayError.textContent = error.message;
  } else {
    displayError.textContent = '';
  }
});

var form = document.getElementById('payment-form');

form.addEventListener('submit', function(ev) {
  ev.preventDefault();

  fetch('/secret', {
    headers : { 
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    }
  })
  .then(function(response) {
    return response.json();
  })
  .then(function(responseJson) {
    clientSecret = responseJson.client_secret;
    // Call stripe.confirmCardPayment() with the client secret.
    stripe.confirmCardPayment(clientSecret, {
      payment_method: {
        card: card,
        billing_details: {
          name: 'Jenny Rosen'
        }
      }
    }).then(function(result) {
      if (result.error) {
        // Show error to your customer (e.g., insufficient funds)
        console.log(result.error.message);
      } else {
        // The payment has been processed!
        if (result.paymentIntent.status === 'succeeded') {
          console.log(result.paymentIntent);
        }
      }
    });
  });

  
});