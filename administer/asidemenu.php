<?php
require_once("advanced/php-login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    //include("advanced/views/logged_in.php");

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
	//echo "<script>window.location='advanced/';</script>";
	header('Location: advanced/');
	
}
?>

<?php
include_once("config.php");
		$result_pc = mysqli_query($con,"SELECT * FROM  `profile`");
		$number_of_pc = mysqli_num_rows($result_pc);
		
		$result_lab = mysqli_query($con,"SELECT * FROM  `labprofile`");
		$number_of_lab = mysqli_num_rows($result_lab);
                
                $result_labusers = mysqli_query($con,"SELECT * FROM  `labusers`");
		$number_of_labusers = mysqli_num_rows($result_labusers);
		
		$today = date("Y-m-d");
			$timeArray = explode (":", date("H:i:s"));
			$x=($timeArray[0]*60*60);
			$y=($timeArray[1]*60)-2*60;
			$z=($timeArray[2]);
			$w=($x+$y+$z);			
		$update_time=gmdate("H:i:s",$w);
		$result = mysqli_query($con,"SELECT * FROM testdata where date = '$today' and ( out_time  > '$update_time'or in_time >'$update_time')");
		$number_of_online =mysqli_num_rows($result);
?>
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
<div class="bg-warning nav-user hidden-xs pos-rlt">
    <div class="nav-avatar pos-rlt"> <a href="#" class="animated rollIn h5" data-toggle="dropdown"><span><?php echo "    ".$_SESSION['user_name'];?></span><span class="caret caret-white"></span> </a>
            <ul class="dropdown-menu m-t-sm animated fadeInUp scroble">
              <span class="arrow top"></span>
              <li> <a href="advanced/edit.php"><?php echo $lang['MENU_PROFILE'];?></a> </li>
             <li> <a href="advanced/register.php"><?php echo $lang['MENU_ADD_USER'];?></a> </li>
             
			  <li class="dropdown-submenu"> <a href="#"><span><?php echo $lang['MENU_LANGUAGE'];?></span> </a> 
				<ul class="dropdown-menu">
                                <li><a href="?lang=ta" title="தமிழ்">தமிழ்</a></li>
<li><a href="?lang=si" title="Sinhala">&#3523;&#3538;&#3458;&#3524;&#3517;</a></li>
				<li><a href="?lang=en" title="English">English</a></li>
              </ul>
			</li>
              <li> <a href="http://jfn-csc-rad-g7.blogspot.com" target="_blank"><?php echo $lang['MENU_HELP'];?></a> </li>
              <li> <a href="advanced/index.php?logout"><?php echo $lang['MENU_LOGOUT'];?></a> </li>
            </ul>
            <div class="visible-xs m-t m-b"> <a href="#" class="h5"><?php echo $_SESSION['user_email'] ;?></a>
  
            </div>
          </div>
          
        </div>
        <nav class="nav-primary hidden-xs animated fadeInLeft">
          <ul class="nav">
		 
            <li> <a href="index.php"> <i class="icon-eye-open "></i> <span><?php echo $lang['MENU_DISCOVER'];?></span> </a> </li>
            <li> <a href="online.php"> <i class="icon-check-sign"></i> <b class="animated fadeInRight badge bg-success pull-right"><?php echo $number_of_online ;?></b><span><?php echo $lang['MENU_ONLINE'];?></span> </a></li>
			<li> <a href="labs.php"> <i class="icon-beaker"></i> <b class="animated fadeInRight badge bg-warning pull-right"><?php echo $number_of_lab ;?></b><span><?php echo $lang['MENU_LAB'];?></span> </a></li>
			<li> <a href="client.php"> <b class="animated fadeInRight badge bg-primary pull-right"><?php echo $number_of_pc ;?></b> <i class="icon-laptop"></i> <span><?php echo $lang['MENU_PC'];?></span> </a> </li>
             
			 <li> <a href="labusers.php"><b class="animated fadeInRight badge bg-white pull-right"><?php echo $number_of_labusers ;?></b> <i class="icon-list"></i> <span><?php echo $lang['MENU_STUDENTS'];?></span> </a> 
			</li>
			
			
			 <li><a href="search.php"> <i class="icon-gears"></i> <span><?php echo $lang['MENU_SEARCH']; ?></span> </a> </li>
			<li><a href="searchc.php"> <i class="icon-gears"></i> <span><?php echo $lang['MENU_SEARCHC']; ?></span> </a></li>
			
			
			
			
			
			
			
			
			
			<li> <a href="#"> <i class="icon-time"></i><strong >   <span id='xClock'></span> </strong></a> </li>
                       
                        
		 
			
			
          </ul>
            
        </nav>
	