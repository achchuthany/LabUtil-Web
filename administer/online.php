<?php
include_once 'config.php';
include_once 'common.php';
$seconds_to_go = 60 - date("s");
if ($seconds_to_go < 15)
    $seconds_to_go += 60;
require_once 'classes/online.php';
$online = new online();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $lang['MENU_ONLINE'] . ' | ' . $lang['PAGE_TITLE']; ?></title>
        <meta name="description" content="<?php echo $lang['PAGE_DESCRIPTION']; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
        <meta http-equiv="Refresh" content="<?php print($seconds_to_go); ?>; URL=<?php print($PHP_SELF); ?>">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="css/app.v1.css">
        <link rel="stylesheet" href="css/font.css" cache="false">
        <!--[if lt IE 9]> <script src="js/ie/respond.min.js" cache="false"></script> <script src="js/ie/html5.js" cache="false"></script> <script src="js/ie/fix.js" cache="false"></script> <![endif]-->

    </head>
    <body>

        <section class="hbox stretch"> <!-- .aside -->
            <aside class="bg-black bg-gradient aside-sm" id="nav">
                <section class="vbox">
                    <header class="dker nav-bar"> <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="body"> <i class="icon-reorder"></i> </a> <a href="#" class="nav-brand" data-toggle="fullscreen"><?php echo $lang['SITE_NAME']; ?></a> <a class="btn btn-link visible-xs" data-toggle="class:show" data-target=".nav-user"> <i class="icon-comment-alt"></i> </a> </header>
                    <footer class="footer bg-gradient hidden-xs"> <a href="modal.lockme.html" data-toggle="ajaxModal" class="btn btn-sm btn-link m-r-n-xs pull-right"> <i class="icon-off"></i> </a> <a href="#nav" data-toggle="class:nav-vertical" class="btn btn-sm btn-link m-l-n-sm"> <i class="icon-reorder"></i> </a> </footer>
                    <section> <!-- user -->
                        <?php include("asidemenu.php"); ?>
                        <!-- / nav --> </section>
                </section>
            </aside>
            <!-- /.aside --> <!-- .vbox -->
            <section id="content">
                <section class="hbox stretch"> <!-- .aside -->
                    <aside class="aside bg-gradient scrollable">
                        <section class="vbox">
                            <header class="bg-black  header">

                                <button class="btn btn-icon btn-info btn-sm pull-right visible-xs m-r-xs" data-toggle="class:show" data-target="#mail-nav"><i class="icon-reorder"></i></button>
                                <p class="h4"><?php echo $lang['ONLINE_PAGE']; ?></p>
                            </header>		  
                            <section>
                                <section>
                                    <section id="mail-nav" class="hidden-xs">
                                        <ul class="nav nav-pills nav-stacked no-radius">				
                                            <li> <a href="?"> <span class="badge pull-right bg-warning"><?php echo $online->get_num_all_online(); ?></span> <i class="icon-list"></i> <?php echo $lang['ONLINE_ALL_LABS']; ?></a> </li>
                                            <?PHP
                                            $online->get_num_cat_online();
                                            ?>
                                            
                                            
                                        </ul>
                                        <p class="divider "></p>
                                        <ul class="nav nav-pills nav-stacked no-radius">				
                                            <li> <a href="?">  <i class="icon-off"></i><strong>   Shut-down Details</strong></a> </li>
                                            <?php
                                           
                                            $online->get_shoutdown_state();
                                            ?>
                                                                             
                                        </ul>

                                    </section>
                                </section>
                            </section>
                        </section>
                    </aside>
                    <!-- /.aside --> <!-- .aside -->
                    <aside class="bg-light lter ">
                        <section class="vbox">
                            <header class="bg-black header clearfix">

                                <div class="btn-toolbar ">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-success"><i class="icon-off"></i><?php echo $lang['ONLINE_SHUTDOWN_OPTION']; ?></button>
                                        <button class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                        <ul class="dropdown-menu animated fadeInUp">
                                            <?php
                                            $online->get_shoutdown_option();
                                            ?>
                                        </ul>

                                    </div>

                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-danger"><i class="icon-off"></i> <?php echo $lang['ONLINE_SHUTDOWN_STOP_OPTION']; ?></button>
                                        <button class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                        <ul class="dropdown-menu animated fadeInUp">
                                            <?php
                                            $online->get_shoutdown_off_option();
                                            ?>
                                        </ul>

                                    </div>

                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-white" data-toggle="tooltip" data-placement="bottom" data-title="Refresh"><i class="icon-refresh"></i><?php echo date("H:i:s"); ?></button>
                                    </div>

                                </div>



                            </header>

                            <section class="scrollable animated fadeInRight">
                                <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-alt list-group-lg">
                                    <?php
                                    require_once 'classes/shutdown.php';
                                    $shoutdown = new shutdown();
                                    if (isset($_GET['shutdown'])) {
                                        $group = $_GET['shutdown'];
                                        $shoutdown->setGroupShutdown($group);
                                    }
                                    if (isset($_GET['stop'])) {
                                        $group = $_GET['stop'];
                                        $shoutdown->setGroupShutdownOFF($group);
                                    }
                                    ?>
                                    <?php
                                    if (isset($_GET['cat'])) {
                                        $online->get_list_online_computers($_GET['cat']);
                                    } else {
                                        $online->get_all_list_online_computers();
                                    }
                                    ?>
                                </ul>
                            </section>
                        </section>
                    </aside>




                </section>
                <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="body"></a> </section>
            <!-- /.vbox --> </section>
        <script src="css/app.v1.js"></script> <!-- Bootstrap --> <!-- App --> <!-- Fuelux -->
    </body>
</html>