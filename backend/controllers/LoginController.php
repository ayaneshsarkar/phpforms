<?php 

  require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/models/Model.php';

  class LoginController extends Model {

    public function login() {

      if(isset($_POST['submit'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $errors = [
          'email' => '', 'password' => '', 'type' => ''
        ];

        $sendValues = [
          'emailValue' => htmlspecialchars($email)
        ];

        // Validate Email

        if(!filter_var($email, FILTER_SANITIZE_EMAIL) && empty($email)) {
          $errors['email'] = 'Field has to be email and cannot be empty.';
        }

        // Validate Password

        if(empty($password) && !filter_var($password, FILTER_SANITIZE_STRING)) {
          $errors['password'] = 'Field cannot be empty.';
        }

        // Checking For Existing Email

        $email = mysqli_real_escape_string($this->db, $email);

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $emailData = mysqli_query($this->db, $sql);
        $emailRow = mysqli_fetch_assoc($emailData);

        if(!empty($email) && $emailRow == NULL) {
          $errors['email'] = 'Email Does Not Exist!';
        }

        $data = [];

        if(count(array_count_values($errors)) != 1) {
          //Showing Errors

          $errors['type'] = 'error';
          $data[] = $errors;
          $data[] = $sendValues;
          return $data;

        } else {
          // Storing Data To Database

          $data = ['type' => 'success'];
          $password = md5($password);

          $sql = "SELECT * FROM users WHERE email = '$email' AND `password` = '$password'";

          $result = mysqli_query($this->db, $sql);
          $userAuth = mysqli_fetch_assoc($result);

          mysqli_free_result($result);
          mysqli_close($this->db);

          if($userAuth != NULL) {
            session_start();
            $_SESSION['userId'] = $userAuth['id'];
            $_SESSION['loggedIn'] = TRUE;

            header('Location: savewithpay');
          } else {
            header('Location: login');
          }
        }

      }

    }

  }

  // Initializing the Controller

  $login = new LoginController;
  $loginData = $login->login();

  $errors = [];
  $emailValue = '';

  // Sending Data To View

  if(!empty($loginData) && $loginData[0]['type'] == 'error') {
    $errors = $loginData[0];

    if(!empty($loginData['emailValue'])) {
      $emailValue = $loginData[1]['emailValue'];
    }
  }