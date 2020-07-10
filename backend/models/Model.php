<?php 
  require_once $_SERVER['DOCUMENT_ROOT'] . '/backend/config/config.php';

  class Model {

    protected $db;

    public function __construct()
    {

      try {
        $this->db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      } catch(Exception $e) {
        echo 'Connection Error: ' . mysqli_connect_error();
      }

    }

  }