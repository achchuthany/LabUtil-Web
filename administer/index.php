
<?php
include_once 'common.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $lang['PAGE_TITLE']; ?></title>
        <meta name="description" content="<?php echo $lang['PAGE_DESCRIPTION']; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="css/app.v1.css">
        <link rel="stylesheet" href="css/font.css" cache="false">
        <!--[if lt IE 9]> <script src="js/ie/respond.min.js" cache="false"></script> <script src="js/ie/html5.js" cache="false"></script> <script src="js/ie/fix.js" cache="false"></script> <![endif]-->
    </head>
    <body>
        <section class="hbox stretch"> <!-- .aside -->
            <aside class="bg-black dker aside-sm" id="nav">
                <section class="vbox">
                    <header class="dker nav-bar"> <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="body"> <i class="icon-reorder"></i> </a> <a href="#" class="nav-brand" data-toggle="fullscreen"><?php echo $lang['SITE_NAME']; ?></a> <a class="btn btn-link visible-xs" data-toggle="class:show" data-target=".nav-user"> <i class="icon-comment-alt"></i> </a> </header>
                    <footer class="footer bg-gradient hidden-xs"> <a href="modal.lockme.html" data-toggle="ajaxModal" class="btn btn-sm btn-link m-r-n-xs pull-right"> <i class="icon-off"></i> </a> <a href="#nav" data-toggle="class:nav-vertical" class="btn btn-sm btn-link m-l-n-sm"> <i class="icon-reorder"></i> </a> </footer>
                    <section> <!-- user -->
                        <?php include("asidemenu.php"); ?>
                        <!-- / nav --> <!-- note -->
                        <div class="bg-danger wrapper hidden-vertical animated rollIn text-sm"> <a href="#" data-dismiss="alert" class="pull-right m-r-n-sm m-t-n-sm"><i class="icon-close icon-remove "></i></a> <?PHP echo $lang['WELCOME_MESSAGE']; ?></div>
                        <!-- / note --> </section>
                </section>
            </aside>
            <!-- /.aside --> <!-- .vbox -->
            <section id="content">
                <section class="vbox  bg-light lter">
                    <header class="header bg-white b-b">
                        <p><?PHP echo $lang['WELCOME_MESSAGE2']; ?></p>
                    </header>
                    <section class="scrollable wrapper">
                        <div class="row">
                            <div class="col-lg-12">
                               
                                <ul class="list-group gutter list-group-lg list-group-sp sortable">
<?php
$today = date("Y-m-d");
$result_work = mysqli_query($con, "SELECT * FROM `profile` where `date` = '$today' LIMIT 0,3");
$row_work = mysqli_num_rows($result_work);
if ($row_work > 0) {
echo' <li class="list-group-item bg-success"> <a href="#" class="pull-right" data-dismiss="alert"><i class="icon-remove"></i></a> <span class="pull-left media-xs"> ' . $row_work .' </span>
                                        <div class="clear"> ' . $lang['INDEX_PROFILE_CREATED'] . '</div>
                                    </li>';
}
?>

                                    
<?php 
$result_work = mysqli_query($con, "SELECT * FROM `pcworkinghours`");
$row_work2 = mysqli_num_rows($result_work);
$result_work = mysqli_query($con, "SELECT * FROM `pcworkinghours` LIMIT 0,1");
while ($row_work = mysqli_fetch_array($result_work)) {

echo' <li class="list-group-item bg-success"> <a href="#" class="pull-right" data-dismiss="alert"><i class="icon-remove"></i></a> <span class="pull-left media-xs"> '.$row_work2 .' </span>
                                        <div class="clear"> '.$lang['INDEX_UPDATE_MESSAGE'].'( ' . $row_work['date'] . ' ' . $row_work['time'] . ' )</div>
                                    </li>';
}
?>
                                    
                                   

                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <header class="panel-heading h4 bg-black">

                                    <?PHP echo $lang['INDEX_USER_HEADER']; ?>


                                </header>
                                <div class="list-group bg-white"> 
                                    <?php
                                    $number = 01;
                                    $result_option = mysqli_query($con, "SELECT * FROM  `levels`");
                                    while ($row = mysqli_fetch_array($result_option)) {
                                        $group = $row['id'];
                                        $result2 = mysqli_query($con, "SELECT * FROM   `labusers` WHERE `level` = '$group'");
                                        $rows = mysqli_num_rows($result2);

                                        echo'<a href="labusers.php?group=' . $row['id'] . '" class="list-group-item"> <i class="icon-chevron-right"></i> <span class="badge btn-primary">  ' . $rows . '  </span> <i class="icon-group"></i>   ' . $row['name'] . ' </a> 
                                 ';
                                    }
                                    ?>

                                </div>  
                            </div>


<?php
$today = date("Y-m-d");
$timeArray = explode(":", date("H:i:s"));
$x = ($timeArray[0] * 60 * 60);
$y = ($timeArray[1] * 60) - 2 * 60;
$z = ($timeArray[2]);
$w = ($x + $y + $z);
$update_time = gmdate("H:i:s", $w);
$result = mysqli_query($con, "SELECT * FROM testdata where date = '$today' and ( out_time  > '$update_time'or in_time >'$update_time')");
$number_of_online = mysqli_num_rows($result);
?>
                            <div class="col-lg-6">
                                <section class="panel">
                                    <header class="panel-heading h4 bg-black">

<?PHP echo $lang['INDEX_ONLINE_HEADER']; ?>


                                    </header>
                                    <div class="list-group bg-white"> 
                                        <a href="online.php" class="list-group-item"> <i class="icon-chevron-right"></i> <span class="badge bg-success"><?php echo $number_of_online; ?></span> <i class="icon-desktop"></i>  Total Online</a> 
<?PHP
$result_option = mysqli_query($con, "SELECT * FROM  `labprofile`");
$today = date("Y-m-d");
$timeArray = explode(":", date("H:i:s"));
$x = ($timeArray[0] * 60 * 60);
$y = ($timeArray[1] * 60) - 2 * 60;
$z = ($timeArray[2]);
$w = ($x + $y + $z);
$update_time = gmdate("H:i:s", $w);

while ($row_option = mysqli_fetch_array($result_option)) {
    $grop = $row_option['name'];
    $result = mysqli_query($con, "SELECT * FROM  `testdata` WHERE  `group` =  '$grop' AND `date`='$today' AND ( `out_time`  > '$update_time'OR `in_time` >'$update_time')");
    $number_of_online = mysqli_num_rows($result);

    echo' <a href="online.php?cat=' . $grop . '" class="list-group-item"> <i class="icon-chevron-right"></i> <span class="badge bg-success"> ' . $number_of_online . '  </span> <i class="icon-desktop"></i>   ' . $grop . '  </a> ';
}
?>

                                    </div>
                                </section>
                                
                                
                                <section class="panel">
                                    <header class="panel-heading h4 bg-black">

<?PHP echo $lang['INDEX_CLIENT_HEADER']; ?>


                                    </header>
                                    <div class="list-group bg-white"> 
                                     
<?php
$number = 01;
$result_option = mysqli_query($con, "SELECT * FROM  `labprofile`");
while ($row = mysqli_fetch_array($result_option)) {
    $group = $row['name'];
    $result2 = mysqli_query($con, "SELECT * FROM   `profile` WHERE `group` = '$group'");
    $rows = mysqli_num_rows($result2);
    mysqli_query($con, "UPDATE `labprofile` SET `noofpc` = '$rows' WHERE `name` = '$group'");

 echo' <a href="client.php?group=' . $row['name'] . '" class="list-group-item"> <i class="icon-chevron-right"></i> <span class="badge bg-warning"> ' . $rows . '  </span> <i class="icon-desktop"></i>   ' . $row['name'] . '  </a> ';
    
}
?>
                                    </div>
                                </section>
                            </div>
                            


                                </section>
             
                               
                            </section>

                          
                        </div>
                    </section>
                </section>
                <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="body"></a> </section>
            <!-- /.vbox --> </section>
        <script src="css/app.v1.js"></script> <!-- Bootstrap --> <!-- Sparkline Chart --> <!-- App -->
    </body>
</html>

      
<?php
//every minute update working time of every pc in our list
$today_date = date("Y-m-d");
$today_time = date("H:i:s");
$result_mac = mysqli_query($con, "SELECT * FROM profile");
while ($row_mac = mysqli_fetch_array($result_mac)) {
    $mac = $row_mac['mac'];
    $c = 0;
    $result_time = mysqli_query($con, "SELECT * FROM  testdata where mac='$mac'");
    while ($row_time = mysqli_fetch_array($result_time)) {
        $timeArray = explode(":", $row_time['on_time']);
        $x = ($timeArray[0] * 60 * 60);
        $y = ($timeArray[1] * 60);
        $z = ($timeArray[2]);
        $w = ($x + $y + $z);
        $c+=$w;
    }
    $work = gmdate("H:i:s", $c);
    $result_check = mysqli_query($con, "SELECT * FROM  pcworkinghours where mac='$mac'");
    $row_check = mysqli_num_rows($result_check);
    //check for if it is available  in pcworking list 
    if ($row_check > 0) {
        $result_update_time = mysqli_query($con, "UPDATE  `pcworkinghours` SET  `date` =  '$today_date',`time` =  '$today_time',work='$work'  WHERE  `mac` =  '$mac'");
        //echo '<tr><td ALIGN="CENTER"> '.$mac.'</td><td ALIGN="CENTER">'.gmdate("H:i:s", $c).'</td><td ALIGN="CENTER">Update '.date('Y-m-d H:i:s').'</td></tr>';
    } else {
        $result_insert_time = mysqli_query($con, "INSERT INTO  `pcworkinghours` (`mac` ,`work` ,`date` ,`time`)VALUES ('$mac',  '$work',  '$today_date',  '$today_time')");
        //echo '<tr><td ALIGN="CENTER"> '.$mac.'</td><td ALIGN="CENTER">'.gmdate("H:i:s", $c).'</td><td ALIGN="CENTER">Insert '.date('Y-m-d H:i:s').'</td></tr>';
    }
}
?>