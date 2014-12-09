<?php
require_once("/advanced/config/config.php");
date_default_timezone_set('Asia/Colombo');  // Set timezone.
$con=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	// Check connection
	if (mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	

?>