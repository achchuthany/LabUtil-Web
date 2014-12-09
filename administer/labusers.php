<?php
include_once 'common.php';
include_once 'config.php';




//every minute update working time of every pc in our list
$today_date = date("Y-m-d");
$today_time = date("H:i:s");
$result_mac = mysqli_query($con, "SELECT * FROM `labusers`");
while ($row_mac = mysqli_fetch_array($result_mac)) {
    $name = $row_mac['name'];
    $c = 0;
    $result_time = mysqli_query($con, "SELECT * FROM  testdata where `user`='$name'");
    while ($row_time = mysqli_fetch_array($result_time)) {
        $timeArray = explode(":", $row_time['on_time']);
        $x = ($timeArray[0] * 60 * 60);
        $y = ($timeArray[1] * 60);
        $z = ($timeArray[2]);
        $w = ($x + $y + $z);
        $c+=$w;
    }
    $work = gmdate("H:i:s", $c);

    //check for if it is available  in pcworking list 

    $result_update_time = mysqli_query($con, "UPDATE  `labusers` SET  `work` =  '$work'  WHERE  `name` =  '$name'");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $lang['MENU_STUDENTS'] . ' | ' . $lang['PAGE_TITLE']; ?></title>
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
                <section class="vbox ">
                    <header class="bg-black dker nav-bar"> <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="body"> <i class="icon-reorder"></i> </a> <a href="#" class="nav-brand" data-toggle="fullscreen"><?php echo $lang['SITE_NAME']; ?></a> <a class="btn btn-link visible-xs" data-toggle="class:show" data-target=".nav-user"> <i class="icon-comment-alt"></i> </a> </header>
                    <footer class="footer bg-gradient hidden-xs"> <a href="modal.lockme.html" data-toggle="ajaxModal" class="btn btn-sm btn-link m-r-n-xs pull-right"> <i class="icon-off"></i> </a> <a href="#nav" data-toggle="class:nav-vertical" class="btn btn-sm btn-link m-l-n-sm"> <i class="icon-reorder"></i> </a> </footer>
                    <section>
<?php include("asidemenu.php"); ?>
                    </section>
                </section>
            </aside>
            <!-- /.aside --> <!-- .vbox -->
            <section id="content">
                <section class="vbox bg-white">
                    <header class="header bg-black bg-gradient">
                        <div class="row text-sm wrapper">
                            <div class="col-sm-5 m-b-xs">
                                <button class="btn btn-success btn-sm h2"><?PHP echo $lang['USER_DETAILS']; ?></button> 
                                <div class="btn-group">
                                    <button class="btn btn-success btn-sm"><?PHP echo $lang['USER_SELECT_LEVEL']; ?></button>
                                    <button class="btn bg-success btn-sm dropdown-toggle" data-toggle="dropdown"><span class="caret bg-success"></span></button>
                                    <ul class="dropdown-menu bg-white animated fadeInUp">
<?php
$result_option = mysqli_query($con, "SELECT * FROM  `levels`");
while ($row_option = mysqli_fetch_array($result_option)) {
    echo '<li><a href="?group=' . $row_option['id'] . '">' . $row_option['name'] . '</a></li>';
}
?>
                                    </ul></div>

                            </div>


                            <div class="col-sm-3">
                                <form method="get">
                                    <div class="input-group">

                                        <input type="text" class="input-sm form-control" placeholder="<?php echo $lang['USER_SEARCH_PLACEHOLDER']; ?>" name="reg">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm btn-white" type="submit"><?PHP echo $lang['USER_SEARCH_BUTTON']; ?></button>

                                        </span>

                                    </div></form>
                            </div>
                        </div>
                    </header>
                    <section class="scrollable wrapper">
                        <div class="tab-content">
                            <section class="tab-pane active" id="wizard">

<?php
if (isset($_GET['group'])) {
    echo '
			  <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
              <i class="icon-ok-sign"></i><strong>' . $lang['LAB_MESSAGE_OK'] . '</strong> ' . $_GET['group'] . '"' . $lang['CLIENT_MESSAGE_GROUP'] . ' </div>
            
			  ';
}
if (isset($_GET['reg'])) {
    echo '
			  <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
              <i class="icon-ok-sign"></i><strong>' . $lang['LAB_MESSAGE_OK'] . '</strong> ' . $_GET['reg'] . ' "' . $lang['CLIENT_MESSAGE_GROUP'] . ' </div>
            
			  ';
}
if (isset($_GET['changeGr'])) {
    $id = $_GET['id'];
    $gr = $_GET['changeGr'];
    $result_option = mysqli_query($con, "UPDATE  `labusers` SET  `level` =  '$gr' WHERE  `id` =  '$id'");
    ECHO '  <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
              <i class="icon-ok-sign"></i><strong>' . $lang['LAB_MESSAGE_OK'] . '</strong>' . $_GET['id'] . '"' . $lang['CLIENT_MESSAGE_CHANGE_GROUP'] . ' ' . $gr . ' </div>
            
			  ';
}
if( isset($_POST['fruit'])  ) {
   $group = $_POST['changeGr'];
    foreach($_POST['fruit'] as $fruit) {
    mysqli_query($con, "UPDATE  `labusers` SET  `level` =  '$group' WHERE  `name` =  '$fruit'");
    ECHO '  <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
              <i class="icon-ok-sign"></i><strong>' . $lang['LAB_MESSAGE_OK'] . '</strong>     ' . $fruit . '"' . $lang['CLIENT_MESSAGE_CHANGE_GROUP'] . '  ' . $group . ' </div>
            ';
       
    }
}
?> <form method="POST">
                                <header class="panel-footer">

                                     <div class="row">
                                       
                                <?php
                                
                               
                                echo '<div class="btn-group">
    <button class="btn btn-primary btn-xs">Change Level</button>
    <button class="btn bg-danger btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
    <ul class="dropdown-menu">';
                                $result3 = mysqli_query($con, "SELECT * FROM  `levels`");
                                while ($row3 = mysqli_fetch_array($result3)) {
                                    echo '<li class="btn"><button class="btn btn-xs btn-primary" type="submit" value="' . $row3['id'] . '" name="changeGr">' . $row3['name'] . '</button></li>';
                                }
                                echo '
    </ul></div>';
                                ?>
                                    </div>  

                                </header>
                               
                                <div class="table-responsive">
                                    <table class="table table-striped b-t text-sm">
                                        <thead>
                                            <tr>
                                                <th width="20"><input type="checkbox"></th>
                                                <th class="th-sortable" data-toggle="class"><?php echo $lang['USER_TABLE_REG']; ?><span class="th-sort"> <i class="icon-sort-down text"></i> <i class="icon-sort-up text-active"></i> <i class="icon-sort"></i> </span> </th>
                                                <th><?php echo $lang['USER_TABLE_LEVEL']; ?></th>
                                                <th><?php echo $lang['USER_TABLE_LAST_LOGON']; ?></th>
                                                <th><?php echo $lang['USER_TABLE_WORK']; ?></th>
                                                <th><?php echo $lang['USER_TABLE_JOIN']; ?></th>
                                                <th width="100"><?php echo $lang['USER_TABLE_PROFILE']; ?> </th>
                                            </tr>
                                        </thead>
                                        <tbody class="animated fadeInUp ">
<?php
$perpage = 30;
if (isset($_GET["page"])) {
    $page = intval($_GET["page"]);
} else {
    $page = 1;
}
$calc = $perpage * $page;
$start = $calc - $perpage;






if (isset($_GET['reg'])) {
    $reg = $_GET['reg'];
    $result2 = mysqli_query($con, 'SELECT * FROM  `labusers` where `name` LIKE "' . $reg . '%" ORDER BY  `name` ASC  LIMIT ' . $start . ',' . $perpage . '');
}
if (isset($_GET['group'])) {
    $group = $_GET['group'];
    $result2 = mysqli_query($con, "SELECT * FROM  `labusers` where `level`='$group' ORDER BY  `name` ASC  LIMIT $start,$perpage");
}

if (!isset($_GET['group']) && !isset($_GET['reg'])) {
    $result2 = mysqli_query($con, "SELECT * FROM  `labusers` ORDER BY  `name` ASC LIMIT $start,$perpage");
}

//page ignation
$rows = mysqli_num_rows($result2);

if ($rows) {
    $i = 0;
    //end pagignation

    while ($row = mysqli_fetch_assoc($result2)) {

        echo '<tr><td><input type="checkbox" name="fruit[]" value="'.$row['name'].'"></td>
					<td>' . $row['name'] . '</td>'
        . '<td>';

        $id_row = $row['level'];
        $re = mysqli_query($con, "SELECT*FROM `levels` where `id` = '$id_row'");
        while ($row2 = mysqli_fetch_array($re)) {
            $name_level = $row2['name'];
        }

        echo '<div class="btn-group">
                <button class="btn btn-white btn-xs">' . $name_level . '</button>
                <button class="btn bg-danger btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                <ul class="dropdown-menu">';
        $result3 = mysqli_query($con, "SELECT * FROM  `levels`");
        while ($row3 = mysqli_fetch_array($result3)) {
            echo '<li><a href="?changeGr=' . $row3['id'] . '&id=' . $row['id'] . '">' . $row3['name'] . '</a></li>';
        }
        echo '
                </ul></div>
					
                                            
					</td>
					 <td>';
        $user = $row['name'];
        $re = mysqli_query($con, "SELECT*FROM `testdata` where `user` = '$user' ORDER BY  `date` DESC  limit 1,1");
        while ($row3 = mysqli_fetch_array($re)) {
            echo '<button class="btn btn-white btn-xs">' . $row3['date'] . ' - ' . $row3['in_time'] . '</button>';
        }

        echo '</td>';
        $user = $row['name'];
        $re = mysqli_query($con, "SELECT*FROM `testdata` where `user` = '$user' ORDER BY  `date` DESC  limit 1,1");
        while ($row3 = mysqli_fetch_array($re)) {
            
        }
        echo'
					<td><button class="btn btn-white btn-xs">' . $row['work'] . '</button></td>
					
					</td>
					<td>' . $row['date'] . '</td><td>
					<a class="btn btn-primary btn-xs" href="userprofile.php?reg=' . $row['name'] . '">Profile <i class="icon-eye-open "></i></a></td>
					</tr>';
    }
}
?>
                                        </tbody>
                                    </table>
                                </div>
    
                                </form>
                                <footer class="panel-footer">
                                    <div class="row">
                                        <div class="col-sm-4 hidden-xs">
                                             <div class="row">
                                       
                                <?php
                                
                               
                                echo '<div class="btn-group">
    <button class="btn btn-primary btn-xs">Change Level</button>
    <button class="btn bg-danger btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
    <ul class="dropdown-menu">';
                                $result3 = mysqli_query($con, "SELECT * FROM  `levels`");
                                while ($row3 = mysqli_fetch_array($result3)) {
                                    echo '<li class="btn"><button class="btn btn-xs btn-primary" type="submit" value="' . $row3['id'] . '" name="changeGr">' . $row3['name'] . '</button></li>';
                                }
                                echo '
    </ul></div>';
                                ?>
                                    </div>  
                                        </div>
                                        <div class="col-sm-4 text-center"> <small class="text-muted inline m-t-sm m-b-sm"></small> </div>
                                        <div class="col-sm-4 text-right text-center-xs">
                                            <ul class="pagination pagination-sm m-t-none m-b-none">

<?php
if (isset($page)) {
    $result = mysqli_query($con, "select Count(*) As Total from labusers");
    $rows = mysqli_num_rows($result2);
    if ($rows) {
        $rs = mysqli_fetch_assoc($result);
        $total = $rs["Total"];
    }
    $totalPages = ceil($total / $perpage);
    if ($page <= 1) {
        echo "<li><a>Prev</a></li>";
    } else {

        $j = $page - 1;

        echo "<li><a  href='?&page=$j'>Prev</a></li>";
    }

    for ($i = 1; $i <= $totalPages; $i++) {

        if ($i <> $page) {

            echo "<li><a  href='?&page=$i'>$i</a></li>";
        } else {

            echo "<li><a>$i</a></li>";
        }
    }

    if ($page == $totalPages) {

        echo "<li><a>Next</a></li>";
    } else {

        $j = $page + 1;

        echo "<li><a  href='?&page=$j'>Next</a></li>";
    }
}
?>

                                            </ul>
                                        </div>
                                    </div>
                                </footer>
                            </section>
                        </div>
                    </section>
                </section>
            </section>
            <!-- /.vbox --> </section>
        <script>
            $(document).ready(function() {
                $('#example').dataTable({
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "include/getpc.php"
                });
            });
        </script>
        <script src="css/app.v1.js"></script> <!-- Bootstrap --> <!-- app --> <!-- fuelux --> <!-- datepicker --> <!-- slider --> <!-- file input --> <!-- combodate --> <!-- parsley --> <!-- select2 -->
    </body>
</html>