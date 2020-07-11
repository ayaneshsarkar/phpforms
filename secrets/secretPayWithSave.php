<?php 

  require_once($_SERVER['DOCUMENT_ROOT'] . '/save/saveWithPayIntent.php');

  class Secret extends Payment {

    public function getClientData() {

      echo json_encode([
        'client_secret' => $this->intent()->client_secret
      ]);

    }

  }

  $init = new Secret;
  $init->getClientData();