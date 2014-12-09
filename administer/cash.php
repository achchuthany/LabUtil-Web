<?php
require_once 'classes/shutdown.php';
if(isset($_POST['clientShoutdown'])){
   $shut = new shutdown();
   $mac = $_POST['clientShoutdown'];     
  echo $shut->getShutdownPC($mac);
  
}
?>
