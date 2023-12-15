<?php
 $this->servername = $_SERVER['SERVER_NAME'];	  
      $this->username = "kardiosi";
      $this->password = "jebiga";
      $this->dbname = "kardiosi_biznis";
          if ( $_SERVER['SERVER_NAME']=="localhost") {
              $this->username = "root";
              $this->password = "";
              $this->dbname = "biznis";
            }
?>