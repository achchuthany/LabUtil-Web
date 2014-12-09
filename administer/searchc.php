<?php
include("config.php");
include_once 'common.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $lang['MENU_SEARCH'] . ' | ' . $lang['PAGE_TITLE']; ?></title>
        <meta name="description" content="<?php echo $lang['PAGE_DESCRIPTION']; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="css/app.v1.css">
        <link rel="stylesheet" href="css/font.css" cache="false">
        <!--[if lt IE 9]> <script src="js/ie/respond.min.js" cache="false"></script> <script src="js/ie/html5.js" cache="false"></script> <script src="js/ie/fix.js" cache="false"></script> <![endif]-->
        <!-- Load jQuery library -->

        <!-- Load custom js -->
        <script type="text/javascript" src="scripts/custom.js"></script>
    </head>
    <body>
        <section class="hbox stretch"> <!-- .aside -->
            <aside class="bg-black dker aside-sm" id="nav">
                <section class="vbox">
                    <header class="bg-black dker nav-bar"> <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="body"> <i class="icon-reorder"></i> </a> <a href="#" class="nav-brand" data-toggle="fullscreen"><?php echo $lang['SITE_NAME']; ?></a> <a class="btn btn-link visible-xs" data-toggle="class:show" data-target=".nav-user"> <i class="icon-comment-alt"></i> </a> </header>
                    <footer class="footer bg-gradient hidden-xs text-center"> <a href="modal.lockme.html" data-toggle="ajaxModal" class="btn btn-sm btn-link hide"> <i class="icon-off"></i> </a> <a href="#nav" data-toggle="class:nav-vertical" class="btn btn-sm btn-link"> <i class="icon-reorder"></i> </a> </footer>
                    <section> <!-- user -->
                        <?php include("asidemenu.php"); ?>
                        <!-- / nav --> </section>
                </section>
            </aside>
            <!-- /.aside --> <!-- .vbox -->
            <section id="content">
                <section class="hbox stretch"> <!-- .aside -->
                    <aside class="col-lg-3">
                        <section class="vbox">
                            <header class=" header bg-black dker">

                                <button class="btn btn-icon btn-info btn-sm pull-right visible-xs m-r-xs" data-toggle="class:show" data-target="#mail-nav"><i class="icon-reorder"></i></button>
                                <p class="h4">Machine Usage Search</p>
                            </header>
                            <section>
                                <section>
                                    <section id="mail-nav" class="hidden-xs">
                                        <p>
                                        <form method="POST">
                                            <ul class="nav nav-pills nav-stacked no-radius ">
                                                <div class="inline pull-left m-r">
                                                    <label>Start Date</label>
                                                    <div class="m-b">
                                                        <input name="sdate"class="input-sm input-s datepicker form-control" size="16" type="text" value="<?php echo $_SESSION['sdate']; ?>" data-date-format="yyyy-mm-dd" >
                                                    </div>
                                                </div>
                                                <div class="inline pull-left m-r">
                                                    <label>End Date</label>
                                                    <div class="m-b">
                                                        <input name ="edate"class="input-sm input-s datepicker form-control" size="16" type="text" value="<?php echo $_SESSION['edate']; ?>" data-date-format="yyyy-mm-dd" >
                                                    </div>
                                                </div>

                                                <div class="inline pull-left m-r form-group">
                                                    <div class="m-b">
                                                        <label>Machine Name</label>
                                                        <select name="mname" id="select2-option" style="width:200px">
                                                            <?php
                                                            $result2 = mysqli_query($con, "SELECT * FROM  `profile`");
                                                            while ($row2 = mysqli_fetch_array($result2)) {

                                                                echo '<option value="' . $row2['mac'] . '">' . $row2['name'] . '</option>';
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-sm-4 col-sm-offset-3">

                                                        <button type="submit" class="btn btn-primary">Search </button>
                                                    </div>
                                                </div>
                                            </ul>
                                        </form></p>
                                    </section>
                                </section>
                            </section>
                        </section>
                    </aside>
                    <!-- /.aside --> <!-- .aside -->
                    <aside class="bg-light">
                        <section class="vbox">
                            <header class="bg-black bg-gradient header clearfix">
                                <p>
                                    <?php
                                    if (isset($_POST['sdate'])) {
                                       
                                        echo '<button class="btn btn-xs btn-warning">Start Date : '.$_POST['sdate'].'  AND End Date : '.$_POST['edate'].' </button>';
                                    }
                                    ?>

                                </p>
                            </header>

                            <section class="scrollable">
                                <ul class="animated fadeInDown list-group no-radius m-b-none m-t-n-xxs list-group-alt list-group-lg">

                                    <div class="panel-body">
                                        <div class="tab-content">



                                            <?php
                                           
                                            if (isset($_POST['mname'])) {
                                                $_SESSION['sdate'] = $_POST['sdate'];
                                                $_SESSION['edate']=$_POST['edate'];
                                               $sdate=$_POST['sdate'];
                                                $edate=$_POST['edate'];
                                                 $mname=$_POST['mname'];
                                                $result = mysqli_query($con, "SELECT * FROM  `testdata` WHERE `mac` = '$mname' AND `date`>='$sdate' and `date`<='$edate'  ");
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $profile_mac = $row['mac'];
                                                    $result2 = mysqli_query($con, "SELECT * FROM  `profile` WHERE mac ='$profile_mac'");
                                                    while ($row2 = mysqli_fetch_array($result2)) {
                                                        $profile_name = $row2['name'];
                                                        $profile_group = $row2['group'];
                                                        $list[$profile_group]+=1;
                                                    }
                                                    echo '
				<li class="list-group-item">

				  <a href="#" class="clear"> <small class="pull-right">Worked Hours ' . $row['on_time'] . '</small> <strong>' . $profile_name . '</strong>
				  <span class="label label-sm bg-danger ">' . $profile_group . '</span>
				  <span> from ' . $row['in_time'] . ' <small> to ' . $row['out_time'] . ' at '.$row['date'].'</small></span>
				  </a>
				  </li>';
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </ul>
                            </section>

                    </aside>


                </section>
                <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="body"></a> </section>
            <!-- /.vbox </section> -->  <script src="css/app.v1.js"></script>
            <!-- Bootstrap --> <!-- App --> <!-- Fuelux -->
    </body>
</html>