var stripe = Stripe('pk_test_QHQBHEgp054jPyeOIOik1DDW00Q1SiFQQO');
var elements = stripe.elements();


// Set up Stripe.js and Elements to use in checkout form
var style = {
  base: {
    color: "#212121",
    fontSize: "16px",
    fontFamily: '"Montserrat", sans-serif',
    fontWeight: '400',

    '::placeholder': {
      color: '#757575',
      fontFamily: '"Montserrat", sans-serif',
      fontWeight: '400'
    }
  }
};

var card = elements.create("card", { style: style });
card.mount("#card-element");

card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});


var form = document.getElementById('payment-form');

form.addEventListener('submit', function(e) {

  e.preventDefault();

  fetch('/savepaysecret').then(function(response) {
    return response.json();
  }).then(function(response) {
    var clientSecret = response.client_secret;

    stripe.confirmCardPayment(clientSecret, {
      payment_method: {
        card: card,
        billing_details: {
          name: 'Ayanesh Sarkar'
        }
      },
      setup_future_usage: 'off_session'
    }).then(function(result) {
      if (result.error) {
        // Show error to your customer
        console.log(result.error.message);
      } else {
        if (result.paymentIntent.status === 'succeeded') {
          swal("Done!", "You just made the payment.", "success");
          setTimeout(function() {
            window.location.href = '/savewithpay';
          }, 1000);
          // Show a success message to your customer
          // There's a risk of the customer closing the window before callback execution
          // Set up a webhook or plugin to listen for the payment_intent.succeeded event
          // to save the card to a Customer
    
          // The PaymentMethod ID can be found on result.paymentIntent.payment_method
        }
      }
    });
  });


});


