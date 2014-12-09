<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of config
 *
 * @author Test
 */
 require_once("advanced/config/config.php");
class config {
    //put your code here
    public $connection;
    function __construct() {
        date_default_timezone_set('Asia/Colombo');
        $this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
    }
}

?>
