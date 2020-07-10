<?php require_once('./includes/header.php'); ?>
<?php require_once('./includes/navbar.php'); ?>


<section id="form">
  <div class="container">
    <h3 class="form_heading">Please Fill Out This Payment Form</h3>

    <form id="payment-form" class="index_form" action="/charge" method="POST">
      <div id="card-element">
        <!-- Elements will create input elements here -->
      </div>
      

      <!-- We'll put the error messages in this element -->
      <div id="card-errors" role="alert"></div>

      <div class="mid_margin"></div>

      <div class="input_button">
        <button class="btn btn-dark" id="submit">Pay</button>
      </div>
    </form>

  </div>
</section>

<script src="https://js.stripe.com/v3/"></script>
<script src="./js/script.js"></script>
<?php require_once("./includes/footer.php"); ?>