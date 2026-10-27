<?php
 $this->servername = "localhost"; // prej: $_SERVER['SERVER_NAME'] - povzročalo napake DNS (getaddrinfo)	  
      $this->username = "kardiosi";
      $this->password = "jebiga";
      $this->dbname = "kardiosi_biznis";
          if ( $_SERVER['SERVER_NAME']=="localhost") {
              $this->username = "root";
              $this->password = "";
              $this->dbname = "biznis";
            }
?>