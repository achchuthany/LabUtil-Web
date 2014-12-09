<?php
require_once("config.php");
$seconds_to_go = 60 - date("s");
if ($seconds_to_go < 15) $seconds_to_go += 60;
?>
<title>Simple Administer   | Lab Utilization  - University of  Jaffna </title>
<meta http-equiv="Refresh" content="<?php print($seconds_to_go); ?>; URL=<?php print($PHP_SELF); ?>">
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<script>
function xClock() {
   xC = new Date;
   xV = vClock(xC.getHours()) + ":" + vClock(xC.getMinutes()) + ":" + vClock(xC.getSeconds());
   document.getElementById("xClock").innerHTML = xV;
   setTimeout("xClock()", 1000);
}
function vClock(v) {
   return (v > 9) ? "" + v : "0" + v;
}
function addLoadEvent(func) {
   var oldonload = window.onload;
   if (typeof window.onload != 'function') {
      window.onload = func;
   } else {
      window.onload = function() {
         if (oldonload) {
            oldonload();
         }
         func();
      }
   }
}
addLoadEvent(xClock);
</script>


<?php  
echo "<h4 align='center'> Date : ". date("Y M d")."   |    Time : <span id='xClock'></span></h4><br>Download Lab Util Software <a href='publish.htm'> Download</a>";
echo'<table  width="800px" align="center">
<tr>
<td colspan="7" ALIGN="CENTER"><h3>Woking PC Entering Table</h3></td>
</tr>
<tr bgcolor="lightgreen" align="center">
<td >ID</td>
<td>Date</td>
<td>MAC Address</td>
<td>Machine Name</td>
<td>User name</td>
<td>Entering Time</td>
<td>Leaving Time</td>
<td>Working Time</td>

<tr/>'; 
if(isset($_GET['Next'])){
	$start =$_GET['start'];
	$end =$_GET['end'];
	$start += 10;
	$end += 10;
}

else{
$start=0;
$end=10;
}
$num=10;
$result=mysqli_query($con,"SELECT * FROM `testdata` ORDER BY id DESC LIMIT $start,$end");
while($row=mysqli_fetch_array($result))
{
echo'<tr bgcolor="lightyellow" align="center">
<td>'.$row["id"].'</td><td>'.$row["date"].'</td><td>'.$row["mac"].'</td><td>'.$row["name"].'</td><td>'.$row["user"].'</td><td>'.$row["in_time"].'</td><td>'.$row["out_time"].'</td><td>'.$row["on_time"].'</td>
<tr/>';
}

$result2=mysqli_query($con,"SELECT * FROM `testdata`");
$rows=mysqli_num_rows($result2);
echo '<tr><td colspan="7" ALIGN="CENTER"><TD></TD></tr>';
echo '<tr>
<TD colspan="1" ALIGN="CENTER"><a href="?Back&start='.$start.'&end='.$end.'">  Back Page </a><TD>
<td colspan="4" ALIGN="CENTER">Showing '.$start.' - '.$end.' of '.$rows.' items </td>
<TD colspan="1" ALIGN="CENTER"><a href="?Next&start='.$start.'&end='.$end.'">  Next Page </a><TD>
</tr>';
echo '</table>';
?>


<?php
echo'<table  width="800px" align="center">
<tr>
<td colspan="7" ALIGN="CENTER"><h3>Working Hours Update Every PC ( at 12.08 pm by default )</h3></td>
</tr>
<tr bgcolor="lightblue" align="center">
<td>MAC Address</td>
<td>Total Working Time</td>
<td>Update Date and Time</td>
<tr/>'; 
?>

<?php
$min=date("i");
$hour=date("H");
$day=date("H");
$month=date("m");
$year=date("Y");
if($hour == 12 && $min==8 ){


//every minute update working time of every pc in our list
	$today_date=date("Y-m-d");
	$today_time=date("H:i:s");
	$result_mac = mysqli_query($con,"SELECT * FROM profile");
	while($row_mac = mysqli_fetch_array($result_mac))
	{
		$mac=$row_mac['mac'];
		$c=0;
		$result_time = mysqli_query($con,"SELECT * FROM  testdata where mac='$mac'");
		while($row_time = mysqli_fetch_array($result_time))
		{
			$timeArray = explode (":", $row_time['on_time'] );
			$x=($timeArray[0]*60*60);
			$y=($timeArray[1]*60);
			$z=($timeArray[2]);
			$w=($x+$y+$z);
			$c+=$w;
		}
		$work=gmdate("H:i:s", $c);
		$result_check = mysqli_query($con,"SELECT * FROM  pcworkinghours where mac='$mac'");
		$row_check = mysqli_num_rows($result_check);
		//check for if it is available  in pcworking list 
		if($row_check > 0){
			$result_update_time = mysqli_query($con,"UPDATE  `pcworkinghours` SET  `date` =  '$today_date',`time` =  '$today_time',work='$work'  WHERE  `mac` =  '$mac'");
			echo '<tr><td ALIGN="CENTER"> '.$mac.'</td><td ALIGN="CENTER">'.gmdate("H:i:s", $c).'</td><td ALIGN="CENTER">Update '.date('Y-m-d H:i:s').'</td></tr>';
		}
		else{
			$result_insert_time = mysqli_query($con,"INSERT INTO  `pcworkinghours` (`mac` ,`work` ,`date` ,`time`)VALUES ('$mac',  '$work',  '$today_date',  '$today_time')");
			echo '<tr><td ALIGN="CENTER"> '.$mac.'</td><td ALIGN="CENTER">'.gmdate("H:i:s", $c).'</td><td ALIGN="CENTER">Insert '.date('Y-m-d H:i:s').'</td></tr>';
		}
	}
	

	
}

//every minute update working time of every pc in our list
	$today_date=date("Y-m-d");
	$today_time=date("H:i:s");
	$result_mac = mysqli_query($con,"SELECT * FROM profile");
	while($row_mac = mysqli_fetch_array($result_mac))
	{
		$mac=$row_mac['mac'];
		$c=0;
		$result_time = mysqli_query($con,"SELECT * FROM  testdata where mac='$mac'");
		while($row_time = mysqli_fetch_array($result_time))
		{
			$timeArray = explode (":", $row_time['on_time'] );
			$x=($timeArray[0]*60*60);
			$y=($timeArray[1]*60);
			$z=($timeArray[2]);
			$w=($x+$y+$z);
			$c+=$w;
		}
		$work=gmdate("H:i:s", $c);
		$result_check = mysqli_query($con,"SELECT * FROM  pcworkinghours where mac='$mac'");
		$row_check = mysqli_num_rows($result_check);
		//check for if it is available  in pcworking list 
		if($row_check > 0){
			$result_update_time = mysqli_query($con,"UPDATE  `pcworkinghours` SET  `date` =  '$today_date',`time` =  '$today_time',work='$work'  WHERE  `mac` =  '$mac'");
			echo '<tr><td ALIGN="CENTER"> '.$mac.'</td><td ALIGN="CENTER">'.gmdate("H:i:s", $c).'</td><td ALIGN="CENTER">Update '.date('Y-m-d H:i:s').'</td></tr>';
		}
		else{
			$result_insert_time = mysqli_query($con,"INSERT INTO  `pcworkinghours` (`mac` ,`work` ,`date` ,`time`)VALUES ('$mac',  '$work',  '$today_date',  '$today_time')");
			echo '<tr><td ALIGN="CENTER"> '.$mac.'</td><td ALIGN="CENTER">'.gmdate("H:i:s", $c).'</td><td ALIGN="CENTER">Insert '.date('Y-m-d H:i:s').'</td></tr>';
		}
	}

echo '</table>';
//end 
?>

<h5 align="center" >Copyright &copy; 2013 , University of Jaffna RAD Team.</h5>