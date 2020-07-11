<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php'); ?>
<?php session_start(); $_SESSION['amount'] = 100; ?>

  <section id="form">
    <div class="container">
      <h3 class="form_heading">Please Fill Out This Payment Form With Payment Save</h3>

      <form id="payment-form" class="index_form" action="#" method="POST">
        <div id="card-element">
        <!-- Elements will create input elements here -->
        </div>

        <!-- We'll put the error messages in this element -->
        <div id="card-errors" role="alert"></div>
        <div class="mid_margin"></div>

        <div class="input_button">
          <button id="submit" class="btn btn-dark">Pay</button>
        </div>
      </form>
      
    </div>
  </section>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="../js/saveWithPay.js"></script>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"); ?>