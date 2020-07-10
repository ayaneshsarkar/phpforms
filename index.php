<?php include('./includes/header.php') ?>
  <?php include('./includes/navbar.php') ?>
  <?php require_once './backend/controllers/RegisterController.php'; ?>

  <!-- FORM -->
  <section id="form">
    <div class="container">
      <h3 class="form_heading">Please Fill Out This Form</h3>
      <?php //(!empty($errors)) ? var_dump($errors) : ''; ?>
      <form action="/" method="POST" class="index_form">
        
        <!-- Firstname -->
        <div class="inputbox">
          <label for="firstname">First Name</label>
          <input type="text" name="firstname" id="firstname" placeholder="Please Enter Your First Name"
           value="<?= $firstname = $sentValues['firstnameValue'] ?? '' ?>">

          <p class="<?= (!empty($errors['firstname'])) ? 'activeError' : 'error' ?>">
            <?= (!empty($errors)) ? $errors['firstname'] : ''; ?>
          </p>

          <div class="mid_margin"></div>
        </div>

        <!-- Lastname -->
        
        <div class="inputbox">
          <label for="lastname">Last Name</label>
          <input type="text" name="lastname" id="lastname" placeholder="Please Enter Your Last Name"
          value="<?= $lastname = $sentValues['lastnameValue'] ?? '' ?>">

          <p class="<?= (!empty($errors['lastname'])) ? 'activeError' : 'error' ?>">
            <?= (!empty($errors)) ? $errors['lastname'] : ''; ?>
          </p>

          <div class="mid_margin"></div>
        </div>

        <!-- Email -->

        <div class="inputbox">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" placeholder="Please Enter Your Email"
          value="<?= $email = $sentValues['emailValue'] ?? '' ?>">

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

        <!-- Confirm Password -->

        <div class="inputbox">
          <label for="confirm_password">Confirm Password</label>
          <input type="password" name="confirm_password" id="confirm_password" 
          placeholder="Please Confirm Password">

          <p class="<?= (!empty($errors['confirm_password'])) ? 'activeError' : 'error' ?>">
            <?= (!empty($errors)) ? $errors['confirm_password'] : ''; ?>
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