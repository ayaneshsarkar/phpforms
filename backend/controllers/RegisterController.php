<?php 

  require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/models/Model.php';

  class RegisterController extends Model {

    public function register() {

      if(isset($_POST['submit'])) {

        $errors = [
          'firstname' => '', 'lastname' => '', 'email' => '', 'password' => '',
          'confirm_password' => '', 'type' => ''
        ];

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        $sendValues = [
          'firstnameValue' => htmlspecialchars($firstname), 
          'lastnameValue' => htmlspecialchars($lastname), 
          'emailValue' => htmlspecialchars($email)
        ];

        // Validate Firstname

        if(empty($firstname) && !filter_var($firstname, FILTER_SANITIZE_STRING)) {
          $errors['firstname'] = 'Field has to be text and cannot be empty.';
        }

        // Validate Lastname

        if(empty($lastname) && !filter_var($lastname, FILTER_SANITIZE_STRING)) {
          $errors['lastname'] = 'Field has to be text and cannot be empty.';
        }

        // Validate Email

        if(!filter_var($email, FILTER_SANITIZE_EMAIL) && empty($email)) {
          $errors['email'] = 'Field has to be email and cannot be empty.';
        }

        // Validate Password

        if(empty($password) && !filter_var($password, FILTER_SANITIZE_STRING)) {
          $errors['password'] = 'Field cannot be empty.';
        }

        // Validate Confirm Password

        if(empty($confirmPassword) && !filter_var($confirmPassword, FILTER_SANITIZE_STRING)) {
          $errors['confirm_password'] = 'Field cannot be empty.';
        }

        // Validate if Password fields are matched

        if($password !== $confirmPassword) {
          $errors['password'] = 'Password and Confirm Password have to be matched.';
          $errors['confirm_password'] = 'Password and Confirm Password have to be matched.';
        }

        // Checking For Existing Email

        $email = mysqli_real_escape_string($this->db, $email);

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $emailData = mysqli_query($this->db, $sql);
        $emailRow = mysqli_fetch_assoc($emailData);

        if($emailRow != NULL) {
          $errors['email'] = 'Email Already Exists!';
        }

        $data = [];

        if(count(array_count_values($errors)) != 1) {
          //Showing Errors

          $errors['type'] = 'error';
          $data[] = $errors;
          $data[]  = $sendValues;
          return $data;

        } else {
          // Storing Data To Database

          $data = ['type' => 'success'];

          $firstname = mysqli_real_escape_string($this->db, $firstname);
          $lastname = mysqli_real_escape_string($this->db, $lastname);
          $password = md5(mysqli_real_escape_string($this->db, $password));

          $sql = "INSERT INTO users (firstname, lastname, email, `password`)
                  VALUES ('$firstname', '$lastname', '$email', '$password')";

          if(mysqli_query($this->db, $sql)) {
            header('Location: /');
          } else {
            echo "Not Added!" . mysqli_error($this->db);
          }
        }

      }

    }

  }

  // Initializing the Controller

  $register = new RegisterController;
  $registerData = $register->register();

  $errors = [];
  $sentValues = [];

  // Sending Data To View

  if(!empty($registerData) && $registerData[0]['type'] == 'error') {
    $errors = $registerData[0];

    if(!empty($registerData[1])) {
      $sentValues = $registerData[1];
    }
  }