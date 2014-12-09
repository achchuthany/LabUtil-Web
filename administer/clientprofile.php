


<?php
include_once 'common.php';
include_once 'config.php';
?>

<?php
	  if(isset($_GET['mac'])){
		$profile_mac=$_GET['mac'];
		$result = mysqli_query($con,"SELECT * FROM  `profile` WHERE mac ='$profile_mac'");
		while($row = mysqli_fetch_array($result))
		  {
			$profile_date = $row['date'];
			$profile_name= $row['name'];
			$profile_ip= $row['ip'];
			$profile_group= $row['group'];
		  }
	  }
	  
	  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $profile_name ."'s ".$lang['MENU_PROFILE'].' | '.$lang['PAGE_TITLE'];?></title>
<meta name="description" content="<?php echo $lang['PAGE_DESCRIPTION']; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="css/app.v1.css">
<link rel="stylesheet" href="css/font.css" cache="false">
<!--[if lt IE 9]> <script src="js/ie/respond.min.js" cache="false"></script> <script src="js/ie/html5.js" cache="false"></script> <script src="js/ie/fix.js" cache="false"></script> <![endif]-->
</head>
<body>
<section class="hbox stretch"> <!-- .aside -->
  <aside class="bg-black aside-sm"id="nav">
    <section class="vbox">
      <header class="bg-black nav-bar"> <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="body"> <i class="icon-reorder"></i> </a> <a href="#" class="nav-brand" data-toggle="fullscreen"><?php echo $lang['SITE_NAME']; ?></a> <a class="btn btn-link visible-xs" data-toggle="class:show" data-target=".nav-user"> <i class="icon-comment-alt"></i> </a> </header>
      <footer class="footer b-r bg-gradient hidden-xs"> <a href="modal.lockme.html" data-toggle="ajaxModal" class="btn btn-sm btn-link m-r-n-xs pull-right"> <i class="icon-off"></i> </a> <a href="#nav" data-toggle="class:nav-vertical" class="btn btn-sm btn-link m-l-n-sm"> <i class="icon-reorder"></i> </a> </footer>
      <section>
         <?php include("asidemenu.php");?>
      </section>
    </section>
  </aside>
  <!-- /.aside --> <!-- .vbox -->
  <section id="content">
    <section class="vbox">
      
	  
	  
      <section class="scrollable">
        <section class="hbox stretch">
          <aside class="aside-lg bg-white b-r">
            <section class="vbox">
              <section class="scrollable bg-light">
                <div class="wrapper ">
                  <div class="clearfix m-b">
                    <div class="clear">
                      <div class="h4 m-t-xs m-b-xs"><?php echo $profile_name;?></div>
                      <small class="text-muted"><?PHP echo $lang['CLIENTPROFILE_GROUP'];?><i class="icon-map-marker"></i> <?php echo $profile_group;?></small> 
					  </div>
                  </div>
                  <div class="panel wrapper">
                    <div class="row">
                      <div class="col-xs-12"> <a href="#"> <span class="m-b-xs h4 block"><?php echo $profile_mac;?></span> <small class="text-muted"><?PHP echo $lang['CLIENTPROFILE_MAC'];?></small> </a> </div>
                    </div>
                  </div>
				  <div class="panel wrapper">
                    <div class="row">
                      <div class="col-xs-12"> <a href="#"> <span class="m-b-xs h4 block"><?php echo $profile_ip;?></span> <small class="text-muted"><?PHP echo $lang['CLIENTPROFILE_IP'];?></small> </a> </div>
                    </div>
                  </div>
				  <?php
if(isset($_GET['mac'])){
        $mac=$_GET['mac'];
		$result = mysqli_query($con,"SELECT * FROM  `pcworkinghours` where mac='$mac'");
		while($row = mysqli_fetch_array($result))
		  {
			$pc_working_time= $row['work'];
			$pc_updateTotal=$row['date'];
			$pc_updatetime=$row['time'];
		  }
		  $result2 = mysqli_query($con,"SELECT * FROM  `testdata` WHERE mac ='$mac' ORDER BY date DESC LIMIT 0,1");
		while($row2 = mysqli_fetch_array($result2))
		{
			 $last_logon=$row2['date'];
			 $last_in=$row2['in_time'];
		}
		$result3 = mysqli_query($con,"SELECT * FROM  `softwaredata` WHERE mac ='$mac' and `software`<>'' ORDER BY `software` ASC");
		$no_of_software = mysqli_num_rows($result3);				
	
	}
?>
				  <div class="panel wrapper">
                    <div class="row">
                      <div class="col-xs-12"> <a href="#"> <span class="m-b-xs h4 block"><?php echo  $last_logon;  ?></span> <small class="text-muted"><?PHP echo $lang['CLIENTPROFILE_LOGIN'];?><?php echo  $last_in;  ?></small> </a> </div>
                    </div>
                  </div>				  
				  <div class="panel wrapper">
                    <div class="row">
                      <div class="col-xs-12"> <a href="#"> <span class="m-b-xs h4 block"><?php echo $pc_working_time;?></span><small class="text-muted"><?PHP echo $lang['CLIENTPROFILE_WORK'];?> <?php echo $pc_updateTotal.' at '. $pc_updatetime?></small> </a> </div>
                    </div>
                  </div>
				   <div class="panel wrapper">
                    <div class="row">
                      <div class="col-xs-12"> <a href="#"> <span class="m-b-xs h4 block"><?php echo $no_of_software;?></span><small class="text-muted"><?PHP echo $lang['CLIENTPROFILE_PROGRAM'];?></small> </a> </div>
                    </div>
                  </div>
                  
				</div>
              </section>
            </section>
          </aside>
		  
	  
          <aside class="bg-white">
            <section class="vbox">
              <header class="header bg-black bg-gradient panel-heading">
                <ul class="nav nav-tabs nav-white">
                  <li class="active"><a href="#activity" data-toggle="tab"><?PHP echo $lang['CLIENTPROFILE_HEADER_PROGRAM'];?></a></li>
                  <li class=""><a href="#events" data-toggle="tab"><?PHP echo $lang['CLIENTPROFILE_HEADER_ACTIVITY'];?></a></li>
                  
                </ul>
              </header>
              <section class="scrollable">
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">
                    <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
						<?php
						$i=1;
						if(isset($_GET['mac'])){
						$profile_mac=$_GET['mac'];
						$result = mysqli_query($con,"SELECT * FROM  `softwaredata` WHERE mac ='$profile_mac' and `software`<>'' ORDER BY `software` ASC");
						while($row = mysqli_fetch_array($result))
						{
							echo '<li class="list-group-item "> 
							<a href="#" class="thumb-sm pull-left m-r-sm"><b class="badge bg-warning" >'.$i++.'</b></a> 
							<a href="#" class="clear"> 
							<small class="pull-right">'.$lang['CLIENTPROFILE_BODY_DBUPDATE'].$row['date'].'</small> 
							<strong class="block">'.$row['software'].'</strong>
							<small>'.$lang['CLIENTPROFILE_BODY_VERSION'].$row['version'].'</small> 
							</a> 
							</li>';
						}
						}
						
						?>
					</ul>	
                  </div>
				  
                  <div class="tab-pane" id="events">
					<ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
						<?php
						
						if(isset($_GET['mac'])){
						$activity_mac=$_GET['mac'];
						$result = mysqli_query($con,"SELECT * FROM  `testdata` WHERE mac ='$activity_mac' ORDER BY date DESC LIMIT 0,30");
						while($row = mysqli_fetch_array($result))
						{
							echo '<li class="list-group-item"> 
							<a href="#" class="clear"> 
							<small class="pull-right"> '.$lang['CLIENTPROFILE_BODY_WORK'].$row['on_time'].'</small> 
							'.$lang['CLIENTPROFILE_BODY_DATE'].$row['date'].' '.$lang['CLIENTPROFILE_BODY_AT'] .$row['in_time'].'
							</a> 
							</li>';
						}
						}
						
						?>                     
					</ul>
                  </div>
                  
                </div>
              </section>
            </section>
          </aside>
          <aside class="col-lg-4 b-l">
            <section class="vbox">
              <section class="scrollable">
                <div class="wrapper">                  
                  
                    
                  <section class="panel bg-light ">
                      <header class="panel-heading  bg-black"><?PHP echo $lang['CLIENTPROFILE_HEADER_HARDDISK']; ?></header>  
			  <?php
				  if(isset($_GET['mac'])){
					$tot_byte=0;
					$use_byte=0;
					$disk_mac=$_GET['mac'];
					$result = mysqli_query($con,"SELECT * FROM  `drivedata` WHERE mac ='$disk_mac'");
					while($row = mysqli_fetch_array($result))
					{
					if($row['tspace']!=0 && $row['taspace'!= 0]){					 
						 $drive_total=$row['tspace'];
						 $tot_byte+=$drive_total;
						 $drive_unused=$row['taspace'];
						 $drive_used=($drive_total- $drive_unused);
						 $use_byte+=$drive_used;
						 $unusep=($drive_unused/$drive_total)*100;
						 $usep=($drive_used/$drive_total)*100;
						 $un_use_gb= $drive_unused/(1024*1024*1024);
						 $use_gb= $drive_used/(1024*1024*1024);
					}
					else{
						$unusep=100;
						$usep=0;
						$un_use_gb=$use_gb=0;
					
					}
					echo '<div class="panel-body btn-white text-center">';
					?>
					<div class='sparkline inline' data-type='pie' data-height='150' data-slice-colors="['#acdb83','#fb6b5b']"><?php echo round($unusep); ?>,<?php echo round($usep); ?></div>
					<?php
					echo '<div class="line  pull-in"></div>';
                    echo '<div class="text-xs bg-light">[ '.$row['type'].' ] '.$row['drive'].' : '.$row['label'].' [ '.$row['filesystem'].' ] <br> <i class="icon-circle text-success"></i>'.$lang['CLIENTPROFILE_BODY_UNUSED'].round($un_use_gb).' GB <i class="icon-circle text-danger"></i>'.$lang['CLIENTPROFILE_BODY_USED'].round($use_gb).' GB </div>';
					echo '</div>';

					}
				}
			  ?>
				 <header class="panel-heading bg-success">  <?php echo $lang['CLIENTPROFILE_BODY_TOTAL_SIZE'].round($tot_byte/(1024*1024*1024));?>   GB  </header> 
				 <header class="panel-heading bg-danger "> <?php echo $lang['CLIENTPROFILE_BODY_USED_SIZE'].round($use_byte/(1024*1024*1024));?>   GB  </header> 
                </section>
					
					
					
                  
                </div>
              </section>
            </section>
          </aside>
        </section>
      </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="body"></a> </section>
  <!-- /.vbox --> </section>
<script src="css/app.v1.js"></script> <!-- Bootstrap --> <!-- App --> <!-- fuelux --> <!-- datatables --> <!-- Sparkline Chart --> <!-- Easy Pie Chart -->
</body>
</html>