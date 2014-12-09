<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'classes/config.php';
/**
 * Description of shutdown
 *
 * @author Test
 */
class shutdown {
    //put your code here
    private $con,$date;
    function __construct() {
        $conn = new config();
        $this->con = $conn->connection;
        $this->date = date("Y-m-d");
    }
    
    public function setGroupShutdown($group){
       $result_name = mysqli_query($this->con, "SELECT * FROM `profile` where `group` = '$group'");
        while ($row_name = mysqli_fetch_array($result_name)) {
            $mac = $row_name['mac'];
            $date = $this->date;
            $result = mysqli_query($this->con, "SELECT `mac` FROM `shutdown` WHERE `mac` = '$mac'");
            $rows = mysqli_num_rows($result);
            if($rows>0){
                 mysqli_query($this->con, "UPDATE `shutdown` SET  `shutdown` =  'Activate',`date`='$date' WHERE  `mac` =  '$mac'");
            }
            else{
                mysqli_query($this->con, "INSERT INTO  `shutdown` (`mac` ,`shutdown` ,`date`) VALUES ('$mac',  'Activate',  ' $date')");
            }
        }
    }
    
    public function setGroupShutdownOFF($group){
        $date = $this->date;
       $result_name = mysqli_query($this->con, "SELECT * FROM `profile` where `group` = '$group'");
        while ($row_name = mysqli_fetch_array($result_name)) {
            $mac = $row_name['mac'];
            
            mysqli_query($this->con, "UPDATE `shutdown` SET  `shutdown` =  'Deactivate',`date`='$date' WHERE  `mac` =  '$mac'");
            
        }
    }
    
    public function getShutdownPC($mac){
        $date = date("Y-m-d");
        $result = mysqli_query($this->con, "SELECT `shutdown` FROM `shutdown` WHERE `mac` = '$mac' and `date` = '$date'");
        while ($row1 = mysqli_fetch_array($result)) {
            $state = $row1['shutdown'];
        }
            return $state;
    }
}

?>
