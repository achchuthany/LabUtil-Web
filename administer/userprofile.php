


<?php
include_once 'common.php';
include_once 'config.php';
?>


<?php
if (isset($_GET['reg'])) {
    $profile_mac = $_GET['reg'];
    $result = mysqli_query($con, "SELECT * FROM  `labusers` WHERE `name` ='$profile_mac'");
    while ($row = mysqli_fetch_array($result)) {
        $profile_join_date = $row['date'];
        $profile_name = $row['name'];
        $profile_work = $row['work'];
        $profile_work_update = $row['update'];
        $profile_level2 = $row['level'];
    }

    $result3 = mysqli_query($con, "SELECT * FROM  `levels` where id = '$profile_level2' ");
    while ($row3 = mysqli_fetch_array($result3)) {
        $profile_level = $row3['name'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $profile_name . "'s " . $lang['MENU_STUDENTS'] . ' | ' . $lang['PAGE_TITLE']; ?></title>
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
<?php include("asidemenu.php"); ?>
                    </section>
                </section>
            </aside>
            <!-- /.aside --> <!-- .vbox -->
            <section id="content">
                <section class="vbox">



                    <section class="scrollable">
                      
                        <section class="scrollable">
                             <header class="panel-heading bg-black"><button type="button" class="btn btn-warning"> <?php echo $profile_name; ?> <small><?php echo $profile_level; ?></small> </button>  <button type="button" class="btn btn-success"><small ><?PHP echo $lang['USER_JOIN_DATE']; ?></small> <?php echo $profile_join_date; ?></button>  <div class="btn-group">
            <button class="btn  btn-info dropdown-toggle" data-toggle="dropdown"><small>Total Working Hrs</small>  <?php echo $profile_work; ?><span class="caret"></span></button>
                                            
                                        </div>
                                    </header>
                                        <div class="tab-content">

                                            <div class="tab-pane active" id="events">
                                                <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
<?php
if (isset($_GET['reg'])) {
    $activity_mac = $_GET['reg'];
    $result = mysqli_query($con, "SELECT * FROM  `testdata` WHERE user ='$activity_mac' ORDER BY date DESC LIMIT 0,30");
    while ($row = mysqli_fetch_array($result)) {
        echo '<li class="list-group-item text-primary"> 
							<a href="#" class="clear"> 
							<small class="pull-right"> ' . $lang['CLIENTPROFILE_BODY_WORK'] . $row['on_time'] . '</small> 
							' . $lang['CLIENTPROFILE_BODY_DATE'] . $row['date'] . ' ' . $lang['CLIENTPROFILE_BODY_AT'] . $row['in_time'] . '
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
                </section>
                <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="body"></a> </section>
            <!-- /.vbox --> </section>
        <script src="css/app.v1.js"></script> <!-- Bootstrap --> <!-- App --> <!-- fuelux --> <!-- datatables --> <!-- Sparkline Chart --> <!-- Easy Pie Chart -->
    </body>
</html>