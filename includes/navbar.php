<?php session_start(); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/backend/controllers/LogoutController.php'); ?>

<nav class="navbar">
  <div class="container">
    <div class="navbar_content">
      <!-- LOGO -->
      <a href="/" class="navbar_logo">
        <h3>PHP</h3>
      </a>

      <!-- NAV ITEMS -->
      <ul class="nav_items">
      <?php if(count($_SESSION) == 0): ?>

        <li class="nav_list"><a href="/">Register</a></li>
        <li class="nav_list"><a href="/login">Login</a></li>

      <?php else: ?>

        <li class="nav_list"><a href="/stripe">Stripe</a></li>
        <li class="nav_list"><a href="/savewithpay">SaveWithPay</a></li>

        <form action="logout" id="logoutForm" method="POST" style="display: hidden">
          <input type="hidden" name="logout" id="logoutInput">
          <input type="submit" hidden="hidden" id="logoutButton">
        </form>
        <li class="nav_list"><a id="logout" href="/savewithpay">Logout</a></li>
        
      <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>

<script>
  if(document.getElementById('logout')) {
    document.getElementById('logout').addEventListener('click', function(e) {
      e.preventDefault();
      document.getElementById('logoutInput').value = 'logout';
      document.getElementById('logoutForm').submit();
    });
  }
</script>