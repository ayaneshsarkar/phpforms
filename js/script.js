var stripe = Stripe('pk_test_QHQBHEgp054jPyeOIOik1DDW00Q1SiFQQO');
var elements = stripe.elements();

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

function handleServerResponse(response) {

  if(response.error) {
    console.log(response.error);
  } else if(response.requires_action) {
    console.log(response.requires_action);
  } else {
    console.log(response);
    swal("Done!", "You just made the payment.", "success");
    setTimeout(function() {
      window.location.href = '/';
    }, 1000);
  }

}

var form = document.getElementById('payment-form');

form.addEventListener('submit', function(e) {

  e.preventDefault();

  stripe.createPaymentMethod({
    type: 'card',
    billing_details: {
      name: 'Ayanesh Sarkar'
    },
    card: card
  }).then(function(result) {
    if(result.error) {
      document.getElementById('card-errors').textContent = result.error.message;
    } else {

      fetch('/charge', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          token: result.paymentMethod.id
        })
      }).then(function(result) {
        return result.json();
      }).then(function(result) {
        handleServerResponse(result);
      });

    }
  })

  
});