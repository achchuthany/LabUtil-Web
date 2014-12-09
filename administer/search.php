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
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
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
                    <aside class="bg-white col-lg-3">
                        <section class="vbox">
                            <header class="bg-black bg-gradient header">          
                                <button class="btn btn-icon btn-info btn-sm pull-right visible-xs m-r-xs" data-toggle="class:show" data-target="#mail-nav"><i class="icon-reorder"></i></button>
                                <p class="h4"><?PHP echo $lang['SEARCH_DETAILS']; ?></p>
                            </header>
                            
                            
                            <section class="scrollable bg-gradient">

                                <section id="mail-nav" class="hidden-xs ">
                                    <form method="get">
                                        <p></p>
                                        <input placeholder="<?PHP echo $lang['SEARCH_INPUT_PLACEHOLDER']; ?>"  class="input-group-sm form-control " name="soft" type="text" id="search" autocomplete="off">
                                        <!-- Show Results -->


                                        <p></p>

                                        <p class="right text-right"><button class="btn btn-success btn-sm"  type="submit" value="Search"><?PHP echo $lang['SEARCH_BUTTON']; ?> </button></p>

                                    </form>
                                    <header class="text-center bg-light lt scrollable" id="results-text"><?PHP echo $lang['SEARCH_RESULT_FOR']; ?> <b id="search-string">  </b></header>
                                    <section class="scrollable">
                                        <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-alt list-group-lg"  id="results"></ul>
                                    </section>
                                </section>
                            </section>
                        </section>
                    </aside>
                    <!-- /.aside --> <!-- .aside -->
                    <aside class="bg-light lter">
                        <section class="vbox">
                            <header class="bg-black bg-gradient header clearfix">                               
                               
                                <p>
                                     <?php
                                    if (isset($_GET['soft'])) {
                                        $_SESSION['soft'] = $_GET['soft'];
                                        $soft =  $_SESSION['soft'];
                                        $result4 = mysqli_query($con, "SELECT DISTINCT mac,software,version,date FROM  `softwaredata` WHERE `software` LIKE '%$soft%'  ");
                                        $nums = mysqli_num_rows($result4);
                                        echo '<button class="btn btn-xs btn-warning">'.$nums.$lang['SEARCH_RESULT_FOUND'].' </button>';
                                    }
                                    
                                    ?>
                                    
                                    </p>
                               </header>

                            <section class="scrollable">
                                <ul class="animated fadeInDown list-group no-radius m-b-none m-t-n-xxs list-group-alt list-group-lg">
                                    
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            
                                            
                                        
                                    <?php
                                    $list = array();
									
                                    if (  isset($_GET['soft']) && !isset($_GET['group']) ) {
                                        $_SESSION['soft'] = $_GET['soft'];
                                        $soft =  $_SESSION['soft'];
                                        $result = mysqli_query($con, "SELECT DISTINCT mac,software,version,date FROM  `softwaredata` WHERE `software` LIKE '%$soft%' ORDER BY `mac` ASC ");
                                        while ($row = mysqli_fetch_array($result)) {
                                            $profile_mac = $row['mac'];
                                            $result2 = mysqli_query($con, "SELECT * FROM  `profile` WHERE mac ='$profile_mac'");
                                            while ($row2 = mysqli_fetch_array($result2)) {
											$profile_name = "null";
											 $profile_group = "null";
											
                                                $profile_name = $row2['name'];
                                                $profile_group = $row2['group'];
                                                $list[$profile_group]+= 1;
                                            }
                                            echo '
				<li class="list-group-item">
				  
				  <a href="#" class="clear"> <small class="pull-right">'.$lang['SEARCH_RESULT_UPDATE'] . $row['date'] . '</small> <strong>' . $profile_name . '</strong> 
				  <span class="label label-sm bg-danger ">' . $profile_group . '</span> 
				  <span>' . $row['software'] . ' <small> ' . $row['version'] . '</small></span> 
				  </a> 
				  </li>';
                                        }
                                    }
                                    
                                    if( isset($_GET['group'])&& isset($_GET['soft']) ){
                                          $soft = $_GET['soft'];
                                         $group = $_GET['group'];
                                        $result = mysqli_query($con, "SELECT DISTINCT mac,software,version,date FROM  `softwaredata` WHERE `software` LIKE '%$soft%' ORDER BY `mac` ASC");
                                        while ($row = mysqli_fetch_array($result)) {
                                            $profile_mac = $row['mac'];
                                            $result2 = mysqli_query($con, "SELECT * FROM  `profile` WHERE mac ='$profile_mac'");
                                            while ($row2 = mysqli_fetch_array($result2)) {
                                                $profile_name = $row2['name'];
                                                $profile_group = $row2['group'];
                                                
                                            }
                                            if($group===$profile_group){
                                            echo '
				<li class="list-group-item">
				  
				  <a href="#" class="clear"> <small class="pull-right">'.$lang['SEARCH_RESULT_UPDATE'] . $row['date'] . '</small> <strong>' . $profile_name . '</strong> 
				  <span class="label label-sm bg-danger ">' . $profile_group . '</span> 
				  <span>' . $row['software'] . ' <small> ' . $row['version'] . '</small></span> 
				  </a> 
				  </li>';
                                            }
                                        }
                                    }
                                    ?>

</div>
                                    </div>
                                </ul>
                            </section>
                            <footer>
                             
                                <section class="panel footer">
                                    <header class="panel-heading bg-light">
                                        <ul class="nav nav-tabs nav-justified">
                                             <?php
                                    foreach ($list as $key => $value) {
                                        echo ' <li><a href="?group='.$key.'&soft='.$_GET['soft'].'" data-toggle="tab"><button class="btn btn-warning">'.$value.' in '.$key .'</button> </a></li>';
                                    }                     
                                    
                                   ?>
                                            
                                        </ul>
                                    </header>
                                    
                                
                          
                        </section>
                            </footer>
                    </aside>


                </section>
                <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="body"></a> </section>
            
        <!-- Bootstrap --> <!-- App <script src="css/app.v1.js"></script> --> <!-- Fuelux -->
    </body>
</html>