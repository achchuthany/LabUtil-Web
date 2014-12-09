<?php
include_once 'common.php';
include_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $lang['MENU_LAB'] . ' | ' . $lang['PAGE_TITLE']; ?></title>
        <meta name="description" content="<?php echo $lang['PAGE_DESCRIPTION']; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="css/app.v1.css">
        <link rel="stylesheet" href="css/font.css" cache="false">
        <!--[if lt IE 9]> <script src="js/ie/respond.min.js" cache="false"></script> <script src="js/ie/html5.js" cache="false"></script> <script src="js/ie/fix.js" cache="false"></script> <![endif]-->
    </head>
    <body>
        <section class="hbox stretch"> <!-- .aside -->
            <aside class="bg-black aside-sm" id="nav">
                <section class="vbox">
                    <header class="dker nav-bar"> <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="body"> <i class="icon-reorder"></i> </a> <a href="#" class="nav-brand" data-toggle="fullscreen"><?php echo $lang['SITE_NAME']; ?></a> <a class="btn btn-link visible-xs" data-toggle="class:show" data-target=".nav-user"> <i class="icon-comment-alt"></i> </a> </header>
                    <footer class="footer bg-gradient hidden-xs"> <a href="modal.lockme.html" data-toggle="ajaxModal" class="btn btn-sm btn-link m-r-n-xs pull-right"> <i class="icon-off"></i> </a> <a href="#nav" data-toggle="class:nav-vertical" class="btn btn-sm btn-link m-l-n-sm"> <i class="icon-reorder"></i> </a> </footer>
                    <section>

                        <?php include("asidemenu.php"); ?>

                    </section>
                </section>
            </aside>
            <!-- /.aside --> <!-- .vbox -->
            <section id="content">
                <section class="vbox">
                    <header class="header bg-black bg-gradient animated fadeInDown">
                        <ul class="nav nav-tabs">

                            <?php
                            $result_option4 = mysqli_query($con, "SELECT * FROM  `labprofile` order by `id` ASC");
                            while ($row_option4 = mysqli_fetch_array($result_option4)) {
                                echo'<li class=""><a href="#' . $row_option4['id'] . '" data-toggle="tab">' . $row_option4['name'] . '</a></li>';
                            }
                            ?>
                            <li ><a href="#element" data-toggle="tab"><?PHP echo $lang['LAB_DETAILS']; ?></a></li> 	  
                        </ul>

                    </header>

                    <section class="scrollable wrapper animated fadeInRight bg-light no-border">
                        <div class="tab-content">
                            <?php
                            if (isset($_POST['addnew'])) {

                                $labname = $_POST['lname'];
                                $date = date("Y-m-d");
                                $np = $_POST['npc'];
                                $result_3 = mysqli_query($con, "SELECT `name` FROM `labprofile` WHERE `name` = '$labname'");
                                $row3 = mysqli_num_rows($result_3);
                                if ($row3 < 1) {
                                    $qury = mysqli_query($con, "INSERT INTO `labprofile` (`name`, `noofpc`, `date`) VALUES ( '$labname', '$np', '$date')");
                                    if (mysqli_errno($con)) {
                                        echo '
                                            <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                                            <i class="icon-ok-sign"></i><strong>'.$lang['LAB_MESSAGE_ALERT'].'</strong> ' . mysqli_error($con) . ' </div>

                                            ';
                                    } else {
                                        echo '
                                            <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                                            <i class="icon-ok-sign"></i><strong>'.$lang['LAB_MESSAGE_OK'].'</strong>' . $_POST['lname'] . '</a>"'.$lang['LAB_MESSAGE_ADD_OK'].'</div>

                                            ';
                                    }
                                } else {
                                    echo '
                                    <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                                    <i class="icon-ok-sign"></i><strong> '.$lang['LAB_MESSAGE_ALERT'].'</strong>' . $_POST['lname'] . '"'.$lang['LAB_MESSAGE_ADD_ALERT'].'</div>';
                                }
                            }


                            if (isset($_GET['DeleteID'])) {
                                $labid = $_GET['DeleteID'];
                                $result_3 = mysqli_query($con, "SELECT `name` FROM `testdata` WHERE `group` = '$labid' LIMIT 0,3");
                                $row3 = mysqli_num_rows($result_3);
                                if ($row3 > 1) {
                                    echo '
                                    <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                                    <i class="icon-ok-sign"></i><strong>'.$lang['LAB_MESSAGE_ALERT'].'</strong> ' . $labid . '"'.$lang['LAB_MESSAGE_DELETE_ALERT'].'</div>';
                                } else {
                                    mysqli_query($con, "DELETE FROM `labprofile` WHERE `name`='$labid'");
                                    if (mysqli_errno($con)) {
                                        echo '
                                            <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                                            <i class="icon-ok-sign"></i><strong>'.$lang['LAB_MESSAGE_ALERT'].'</strong> ' . mysqli_error($con) . ' </div>

                                            ';
                                    } else {
                                        echo '  <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                                    <i class="icon-ok-sign"></i><strong>'.$lang['LAB_MESSAGE_OK'].' </strong>' . $_GET['DeleteID'] . '"'.$lang['LAB_MESSAGE_DELETE_OK'].'</div>
                                    ';
                                    }
                                }
                            }
                            ?>


                            <?php
                            $result_option5 = mysqli_query($con, "SELECT * FROM  `labprofile` order by id ASC");
                            while ($row_option5 = mysqli_fetch_array($result_option5)) {
                                $lab_name = $row_option5['name'];
                                echo '<section class="tab-pane active " id="' . $row_option5['id'] . '">
            <div class="row">
			   <div class="col-lg-12">
                <section class="panel bg-dark">
                  <header class="panel-heading bg-black"><button type="button" class="btn btn-warning"> ' . $lab_name . ' </button>  <button type="button" class="btn btn-success">' . $lang['LAB_SELECTED_DATE'];
                                if (isset($_GET['date'])) {
                                    $date = $_GET['date'];
                                    echo $date;
                                } else {
                                    $date = date("Y-m-d");
                                    echo $date;
                                }
                                echo' </button>  <div class="btn-group">
                <button class="btn  btn-info dropdown-toggle" data-toggle="dropdown"> ' . $lang['LAB_SELECT_DATE'] . '<span class="caret"></span></button>
                <ul class="dropdown-menu animated fadeInUp">  ';

                                $result_option2 = mysqli_query($con, "SELECT DISTINCT `date` FROM  `testdata` where `group` ='$lab_name' order by `date` DESC LIMIT 0,30");
                                while ($row_option2 = mysqli_fetch_array($result_option2)) {
                                    echo '<li><a href="?date=' . $row_option2['date'] . '">' . $row_option2['date'] . '</a></li>';
                                }
                                echo'
                </ul>
              </div>
				 </header>
				  
				
				  
                  <div class="panel-body bg-black">                
                    <div class="sparkline" data-type="line" data-resize="true" 
					data-height="450" data-width="100%" data-line-width="0.5" 
					data-line-color="#ffcfff" data-spot-color="#fff"
					data-fill-color="#afffff" data-highlight-line-color="#fff" 
					data-spot-radius="3.5"
			
			';
                                if (isset($_GET['date'])) {
                                    $date = $_GET['date'];
                                } else {
                                    $date = date("Y-m-d");
                                }

                                $numbers = array();
                                $update_time = "08:00:00";
                                $i = 0;
                                while ($update_time < "18:00:00") {
                                    $timeArray = explode(":", $update_time);
                                    $x = ($timeArray[0] * 60 * 60) + 1 * 15 * 60;
                                    $y = ($timeArray[1] * 60);
                                    $z = ($timeArray[2]);
                                    $w = ($x + $y + $z);
                                    $update_time = gmdate("H:i:s", $w);
                                    $result_option2 = mysqli_query($con, "SELECT * FROM  `testdata` where `group` ='$lab_name' and `date`='$date' and `in_time` <= '$update_time' and `out_time` >='$update_time' ");
                                    $num_of_pc = mysqli_num_rows($result_option2);
                                    $numbers[$i++] = $num_of_pc;
                                }
                                ?>
                                data-data="[<?php echo $numbers[0]; ?>,<?php echo $numbers[1]; ?>,<?php echo $numbers[2]; ?>,<?php echo $numbers[3]; ?>,<?php echo $numbers[4]; ?>,<?php echo $numbers[5]; ?>,<?php echo $numbers[6]; ?>,<?php echo $numbers[7]; ?>,<?php echo $numbers[8]; ?>,<?php echo $numbers[9]; ?>,<?php echo $numbers[10]; ?>,<?php echo $numbers[11]; ?>,<?php echo $numbers[12]; ?>,<?php echo $numbers[13]; ?>,<?php echo $numbers[14]; ?>,<?php echo $numbers[15]; ?>,<?php echo $numbers[16]; ?>,<?php echo $numbers[17]; ?>,<?php echo $numbers[18]; ?>,<?php echo $numbers[19]; ?>,<?php echo $numbers[20]; ?>,<?php echo $numbers[21]; ?>,<?php echo $numbers[22]; ?>,<?php echo $numbers[23]; ?>,<?php echo $numbers[24]; ?>,<?php echo $numbers[25]; ?>,<?php echo $numbers[26]; ?>,<?php echo $numbers[27]; ?>,<?php echo $numbers[28]; ?>,<?php echo $numbers[29]; ?>,<?php echo $numbers[30]; ?>,<?php echo $numbers[31]; ?>,<?php echo $numbers[32]; ?>,<?php echo $numbers[33]; ?>,<?php echo $numbers[34]; ?>,<?php echo $numbers[35]; ?>,<?php echo $numbers[36]; ?>,<?php echo $numbers[37]; ?>,<?php echo $numbers[38]; ?>,<?php echo $numbers[39]; ?>]">
                                <?php
                                echo '</div>
                    <ul class="list-inline text-muted axis">';


                                $update_time = "08:00:00";
                                //echo ' <li>08:00 am</li>';
                                while ($update_time < "18:00:00") {
                                    $timeArray = explode(":", $update_time);
                                    $x = ($timeArray[0] * 60 * 60) + 1 * 30 * 60;
                                    $y = ($timeArray[1] * 60);
                                    $z = ($timeArray[2]);
                                    $w = ($x + $y + $z);
                                    $update_time = gmdate("H:i:s", $w);
                                    echo ' <li>' . $update_time . '</li>';
                                }

                                echo'    </ul>
                  </div>
				   <header class="panel-heading bg-black">' . $lang['LAB_CHART_FOOTER'] . '</header>
                </section>
              </div>	
	';
                                echo'<section  class="tab-pane scrollable wrapper">
				<div class="table-responsive scrollable wrapper">
				<table class="center table table-striped text-sm scrollable wrapper">
                  <thead>
                    <tr>   
		      <th width="7%">' . $lang['LAB_TABLE_NO'] . '</th>					
                      <th width="10%">' . $lang['LAB_TABLE_UPDATE_TIME'] . '</th>
                      <th width="8%">' . $lang['LAB_TABLE_NO_COMPUTER'] . '</th>
                      
                      <th width="75%">
                     ' . $lang['LAB_TABLE_MORE'] . '
                      </th>
                     
                      
                    </tr>
                  </thead>
				 
                                  
                                 
				  ';

                                if (isset($_GET['date'])) {
                                    $date = $_GET['date'];
                                } else {
                                    $date = date("Y-m-d");
                                }
                                $i = 1;
                                $update_time = "08:00:00";
                                while ($update_time < "18:00:00") {
                                    $timeArray = explode(":", $update_time);
                                    $x = ($timeArray[0] * 60 * 60) + 1 * 15 * 60;
                                    $y = ($timeArray[1] * 60);
                                    $z = ($timeArray[2]);
                                    $w = ($x + $y + $z);

                                    $update_time = gmdate("H:i:s", $w);
                                    echo '
					<tr>
					<td>' . $i++ . ' </td>
					<td> <span class="badge bg-light">' . $update_time . '</span> </td>
					<td><span class="badge bg-success">' . $num_of_pc . '</span></td>
					<td>
					
			
			<table class="table table-striped scrollable wrapper">
                        
					';
                                    $result_option2 = mysqli_query($con, "SELECT * FROM  `testdata` where `group` ='$lab_name' and  `date`='$date' and `in_time` <= '$update_time' and out_time >='$update_time' ");
                                    while ($row_option2 = mysqli_fetch_array($result_option2)) {
                                        echo '<tr ><td>		
			' . $row_option2['name'] . '</td> <td> ' . $row_option2['user'] . '</td>
			<td>' . $row_option2['in_time'] . '</td> <td>
			' . $row_option2['out_time'] . '</td></tr>								
					';
                                    }
                                    $num_of_pc = mysqli_num_rows($result_option2);
                                    echo '
					</table>
					</span> 
					</td>
					</tr>';
                                }


                                echo' </tbody></table>
				  </div></section>		  
			</section>';
                            }
                            ?>
                            <section class="tab-pane" id="element">

                                <section class="panel">
                                    <header class="panel-heading"> <a href="#NEW" data-toggle="tab" ><button class="btn btn-success btn-sm"><?php echo $lang['LAB_TABLE_ADD']; ?></button> </a> </header>

                                    <div class="table-responsive">
                                        <table class="table table-striped b-t text-sm">
                                            <thead>
                                                <tr>
                                                    <th width="20"><input type="checkbox"></th>
                                                    <th class="th-sortable" data-toggle="class"> <?php echo $lang['LAB_TABLE_LAB_NAME']; ?></th>
                                                    <th> <?php echo $lang['LAB_TABLE_LAB_COMPUTES']; ?></th>
                                                    <th> <?php echo $lang['LAB_TABLE_LAB_JOIN_DATE']; ?></th>
                                                    <th width="150"> <?php echo $lang['LAB_TABLE_OPERATION']; ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $result_option7 = mysqli_query($con, "SELECT * FROM  `labprofile` order by id ASC");
                                                while ($row_option7 = mysqli_fetch_array($result_option7)) {
                                                    echo '
                                                <tr>
                                                    <td><input type="checkbox" name="post[]" value="2"></td>
                                                    <td>' . $row_option7['name'] . '</td>
                                                    <td>' . $row_option7['noofpc'] . '</td>
                                                    <td>' . $row_option7['date'] . '</td>
                                                    <td><a href="?DeleteID=' . $row_option7['name'] . '"<i class="icon-remove text-danger text">DELETE</i></a></td>
                                                </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <footer class="panel-footer">
                                        <div class="row">

                                            <div class="col-sm-4 text-center"> <small class="text-muted inline m-t-sm m-b-sm"></small> </div>

                                        </div>
                                    </footer>
                                </section>

                            </section>
                            <section class="tab-pane" id="NEW">
                                <header class="panel-heading"><a href="#element" data-toggle="tab"><button class="btn btn-info btn-sm"><?php echo $lang['LAB_DEATLS_BACK']; ?></button></a> | <?php echo $lang['LAB_ADD_NEW_LAB']; ?>  </header>



                                <form class="form-horizontal" method="post" data-validate="parsley">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo $lang['LAB_FORM_NAME']; ?></label>
                                        <div class="col-sm-4">
                                            <input type="text" name="lname" placeholder="LAB_01" class="bg-focus form-control" data-required="true">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo $lang['LAB_FORM_COMPUTERS']; ?></label>
                                        <div class="col-sm-4">
                                            <input type="text" name="npc" placeholder="27" class="bg-focus form-control" data-required="true" data-min="5" data-max="100" data-type="number">
                                            <div class="line line-dashed m-t-lg"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-3">
                                            <button type="reset" class="btn btn-white"><?php echo $lang['LAB_FORM_CANCEL']; ?></button>
                                            <button type="submit" name ="addnew"class="btn btn-primary"><?php echo $lang['LAB_FORM_SAVE']; ?></button>
                                        </div>
                                    </div>
                                </form>

                            </section>
                        </div>
                    </section>
                </section>
            </section>
            <!-- /.vbox --> </section>
        <script src="css/app.v1.js"></script> <!-- Bootstrap --> <!-- app --> <!-- fuelux --> <!-- datepicker --> <!-- slider --> <!-- file input --> <!-- combodate --> <!-- parsley --> <!-- select2 -->
    </body>
</html>