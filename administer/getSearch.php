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

                    <!-- /.aside --> <!-- .aside -->
                    <aside class="bg-light lter">
                        <section class="vbox">
                            <header class="bg-success header clearfix">
                                <div class="btn-toolbar pull-left">

                                    <p class="h4">Advance Search </p>
                                </div></header>

                            <section class="scrollable">
                                <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-alt list-group-lg">
                                    <section class="panel clearfix">
                                        <div class="wizard wizard-vertical clearfix" id="wizard-2">
                                            <ul class="steps">
                                                <li data-target="#step4" class="active"><span class="badge badge-info">1</span>Select Lab</li>
                                                <li data-target="#step5"><span class="badge">2</span>Unzip it</li>
                                                <li data-target="#step6"><span class="badge">3</span>Finish</li>
                                            </ul>
                                        </div>
                                       
                                        <div class="step-content">
                                             <form method="POST">
                                            <div class="step pane active " id="step4">
                                                <p class="">You can select one lab at a time<br>
                            <?php
                            $result_option4 = mysqli_query($con, "SELECT * FROM  `labprofile` order by `id` ASC");
                            while ($row_option4 = mysqli_fetch_array($result_option4)) {
                                echo'<h4 class="btn "><input  type="radio" name="group" value="' . $row_option4['name'] . '">  ' . $row_option4['name'] . '</h4>';
                            }
                            ?>
                                                    
                                                   
                                                    
                                                </p>
                                            </div>
                                            <div class="step-pane" id="step5">
                                                <p>Unzipping this file, please wait it complete...</p>
                                                
                                               
                                            </div>
                                            <div class="step-pane" id="step6">
                                                <p>Thank you for choose this theme for your web application. <br>
                                                    Have Fun!</p>
                                            </div>
                                            <div class="actions m-t text-right">
                                                <button type="button" class="btn btn-white btn-sm btn-prev" data-target="#wizard-2" data-wizard="previous" disabled="disabled">Prev</button>
                                                <button type="button" class="btn btn-white btn-sm btn-next" data-target="#wizard-2" data-wizard="next" data-last="Finish">Next</button>
                                            </div>
                                                  </form>
                                        </div>
                                      
                                    </section>


                                </ul>
                            </section>
                        </section>
                    </aside>


                </section>
                <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="body"></a> </section>
            <!-- /.vbox --> </section>
        <!-- Bootstrap --> <!-- App --> <!-- Fuelux --><script src="css/app.v1.js"></script>
    </body>
</html>