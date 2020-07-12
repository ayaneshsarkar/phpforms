<?php 

  class Logout {

    public function __construct()
    {
      if($_SERVER['REQUEST_METHOD'] == 'GET') {

        echo "GET METHOD ERROR";
      }

    }

    public function logout() {

      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        session_start();
        
        unset($_SESSION['userID']);
        $_SESSION['loggedIn'] = FALSE;
        session_destroy();

        header('Location: login');
        
      }

    }

  }

  $logout = new Logout;
  $logout->logout();