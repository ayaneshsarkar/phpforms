<?php include('./includes/header.php') ?>
  <?php include('./includes/navbar.php') ?>
  <?php require_once './backend/controllers/LoginController.php'; ?>

  <!-- FORM -->
  <section id="form">
    <div class="container">
      <h3 class="form_heading">Please Fill Out This Form</h3>
      
      <form action="login" method="POST" class="index_form">

        <!-- Email -->

        <div class="inputbox">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" placeholder="Please Enter Your Email"
          value="<?= $emailValue; ?>">

          <p class="<?= (!empty($errors['email'])) ? 'activeError' : 'error' ?>">
            <?= (!empty($errors)) ? $errors['email'] : ''; ?>
          </p>

          <div class="mid_margin"></div>
        </div>

        <!-- Password -->

        <div class="inputbox">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" placeholder="Please Enter Your Password">
          <p class="<?= (!empty($errors['password'])) ? 'activeError' : 'error' ?>">
            <?= (!empty($errors)) ? $errors['password'] : ''; ?>
          </p>
          <div class="mid_margin"></div>
        </div>
        
        <!-- Submit Button -->

        <div class="input_button">
          <button class="btn btn-dark" type="submit" name="submit">Submit</button>
        </div>
      </form>
    </div>

    <?= $data ?? ''; ?>

  </section>  
<?php include('./includes/footer.php') ?>

