<?php

require_once("config.php");
$time = date("H:i:s");
$date = date("Y-m-d");



//get a entry request from the client application and strore in the databse
if (isset($_POST['in'])) {
    //set entry time
    $in_time = date("H:i:s");
    //set Machine Name
    $achchu = $_POST['in'];
    //set MAC Address
    $mac = $_POST['mac'];
    //set local machine user name
    $user = $_POST['user'];
    
    //Get group of entring Machine  
    $result_group = mysqli_query($con, "SELECT * FROM `profile` WHERE `mac` = '$mac' LIMIT 2");
    while ($row_group = mysqli_fetch_array($result_group)) {
        //set Group of Lab
        $group = $row_group['group'];
    }
    
    //insert into to databse all details of entring machine
    mysqli_query($con, "INSERT INTO `testdata` (`name`,`in_time`,`mac`,`date`,`group`,`user`)VALUES ('$achchu','$in_time','$mac','$date','$group','$user')");
    $row_id = "";
    $result = mysqli_query($con, "SELECT * FROM testdata ORDER BY id DESC LIMIT 1");
    while ($row = mysqli_fetch_array($result)) {
        //set databse entry ID and return to the client
        $row_id = $row['id'];
    }
    //update user deatils in user table
    $result6 = mysqli_query($con, "SELECT * FROM `labusers` WHERE `name` = '$user' LIMIT 2");
    $rows = mysqli_num_rows($result6);
    if ($rows < 1) {
        $sql = "INSERT INTO `labusers` (`name`, `level`, `date`) VALUES ( '$user', '10', '$date')";
        mysqli_query($con, $sql);
    }

    //update user working hours	
    else {
        $sql5 = "SELECT * FROM `labusers` WHERE `name` = '$user'";
        $update_last = "";
        $result_time = mysqli_query($con, $sql5);
        while ($row_time = mysqli_fetch_array($result_time)) {
            $update_last = $row_time['update'];
        }
        $sql4 = "SELECT * FROM  `testdata` WHERE  `date` >= '$update_last' and `date` <> '$date'";
        $c = 0;

        $result_time = mysqli_query($con, $sql4);
        while ($row_time = mysqli_fetch_array($result_time)) {
            $timeArray = explode(":", $row_time['on_time']);
            $x = ($timeArray[0] * 60 * 60);
            $y = ($timeArray[1] * 60);
            $z = ($timeArray[2]);
            $w = ($x + $y + $z);
            $c+=$w;
        }
        $old_time = 0;
        $sql5 = "SELECT * FROM `labusers` WHERE `name` = '$user'";
        while ($row_time = mysqli_fetch_array($result_time)) {
            $old_time = $row_time['work'];
        }
        $cc = 0;
        $x = 0;
        $y = 0;
        $z = 0;
        $w = 0;
        $timeArray = explode(":", $old_time);
        $x = ($timeArray[0] * 60 * 60);
        $y = ($timeArray[1] * 60);
        $z = ($timeArray[2]);
        $w = ($x + $y + $z);
        $cc = $w + $c;

        $work = gmdate("H:i:s", $cc);

        $sql2 = "UPDATE `labusers` SET  `work` =  '$work', `update` =  '$date' WHERE  `name` ='$user'";
        $result7 = mysqli_query($con, $sql2);
    }
    mysqli_close($con);
    //send a welcome message to the client application 
    echo "Welcome ! $user  \n#" . date("h:i:s A") . "#" . $row_id;
}

if (isset($_POST['stopshutdown'])) {
    $macc = $_POST['stopshutdown'];
    mysqli_query($con, "UPDATE  `shutdown` SET  `shutdown` =  'Deactivate'  WHERE  `mac` ='$macc'");
}
if (isset($_POST['out'])) {
    $out_time = date("H:i:s");
    $achchu = $_POST['out'];
    $runtime = $_POST['time'];
    $row_id = $_POST['row_id'];
    if ($row_id == "") {
        $mac = $_POST['mac'];
        $result_group = mysqli_query($con, "SELECT * FROM `profile` WHERE `mac` = '$mac' LIMIT 2");
        while ($row_group = mysqli_fetch_array($result_group)) {
            $group = $row_group['group'];
        }
        mysqli_query($con, "INSERT INTO `testdata` (`name`,`in_time`,`mac`,`date`,`group`)VALUES ('$achchu','$in_time','$mac','$date','$group')");
        $row_id = "";
        $result = mysqli_query($con, "SELECT * FROM testdata ORDER BY id DESC LIMIT 1");
        while ($row = mysqli_fetch_array($result)) {
            $row_id = $row['id'];
        }

        echo "Welcome !\n " . date("h:i:s A") . "#" . $row_id;
    } else {
        mysqli_query($con, "UPDATE  `testdata` SET  `on_time` =  '$runtime' , `out_time`='$out_time' WHERE  `id` ='$row_id'");
        mysqli_close($con);
        echo "Your machine is " . $achchu . " and database updated at " . date("h:i:s A");
    }
}

if (isset($_POST['getdate'])) {
    $mac = $_POST['mac'];
    $getdate_str = "No Data";
    $getin_time = "No Data";
    $getout_time = "No Data";
    $geton_time = "No Data";
    $result = mysqli_query($con, "SELECT * FROM  `testdata` WHERE mac ='$mac' ORDER BY id DESC LIMIT 2");
    while ($row = mysqli_fetch_array($result)) {
        $getdate_str = $row['date'];
        $getin_time = $row['in_time'];
        $getout_time = $row['out_time'];
        $geton_time = $row['on_time'];
    }
    echo $getdate_str . "#" . $getin_time . "#" . $getout_time . "#" . $geton_time;
}

if (isset($_POST['soft'])) {
    $soft = $_POST['soft'];
    $mac = $_POST['mac'];
    $result = mysqli_query($con, "SELECT * FROM  `softwaredata` WHERE mac ='$mac'");
    $row = mysqli_num_rows($result);
    if ($row >= 1) {

        $List = explode("#", $soft);
        if (sizeof($List) - $row == 4) {
            echo 'In this machine  ' . (sizeof($List) - 4) . ' software is available But in server ' . ($row) . ' software available. This time update is not needed.';
        } else {
            $result = mysqli_query($con, "DELETE FROM  `softwaredata` WHERE `mac` = '$mac'");
            $i = 1;
            foreach ($List as $v) {
                $id = $mac . "#" . $i;
                $List1 = explode("*", $v);
                {
                    mysqli_query($con, "INSERT INTO `softwaredata` (`id`,`mac`, `software`, `date`, `version`) VALUES ('$id','$mac', '$List1[0]', '$date', '$List1[1]')");
                    $i = $i + 1;
                }
            }
            echo "Your machine software list successfully updated in Server.";
        }
    } else {
        $i = 1;
        $List = explode("#", $soft);
        foreach ($List as $v) {
            $id = $mac . "#" . $i;
            $List1 = explode("*", $v);
            {

                mysqli_query($con, "INSERT INTO `softwaredata` (`id`,`mac`, `software`, `date`, `version`) VALUES ('$id','$mac', '$List1[0]', '$date', '$List1[1]')");
            }
            $i = $i + 1;
        }
        echo "Your Machine software list successfully inserted in Server.";
    }
}


if (isset($_POST['drive'])) {
    $mac = $_POST['mac'];
    $result = mysqli_query($con, "SELECT * FROM  `drivedata` WHERE mac ='$mac' ORDER BY id DESC LIMIT 3");
    $row = mysqli_num_rows($result);
    if ($row >= 1) {
        $result = mysqli_query($con, "DELETE FROM  `drivedata` WHERE `mac` = '$mac'");
        $a = explode("-", $_POST['drive']);
        foreach ($a as $v) {
            $a1 = explode("#", $v); {
                $a2 = explode(":", $a1[0]);
                //echo $a2[0];
                //echo$a1[0]."  ".$a1[1]."   ".$a1[2]."   ".$a1[3]."   ".$a1[4]."   ".$a1[5]."   ".$a1[6]."\n";
                if ($a1[4] != null) {
                    mysqli_query($con, "INSERT INTO `drivedata` (`mac`, `drive`, `type`, `label`, `filesystem`, `usertaspace`, `taspace`, `tspace`,`date`) VALUES ( '$mac', '$a2[0]', '$a1[1]', '$a1[2]', '$a1[3]', '$a1[4]', '$a1[5]', '$a1[6]','$date')");
                }
            }
        }
        echo "Old Drive list is updated in Server.";
    } else {
        $a = explode("-", $_POST['drive']);
        foreach ($a as $v) {
            $a1 = explode("#", $v);
            $a2 = explode(":", $a1[0]);
            //echo$a1[0]."  ".$a1[1]."   ".$a1[2]."   ".$a1[3]."   ".$a1[4]."   ".$a1[5]."   ".$a1[6]."\n";
            if ($a1[4] != null) {
                mysqli_query($con, "INSERT INTO `drivedata` (`mac`, `drive`, `type`, `label`, `filesystem`, `usertaspace`, `taspace`, `tspace`,`date`) VALUES ( '$mac', '$a2[0]', '$a1[1]', '$a1[2]', '$a1[3]', '$a1[4]', '$a1[5]', '$a1[6]' ,'$date')");
            }
        }
        echo "New Drive list is updated in Server.";
    }
}


if (isset($_POST['makeprofile'])) {
    $mac = $_POST['mac'];
    $ip = $_POST['ip'];
    $name = $_POST['name'];
    $result = mysqli_query($con, "SELECT * FROM  `profile` WHERE mac ='$mac'");
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $pro_name = $row['name'];
            $pro_mac = $row['mac'];
            $pro_date = $row['date'];
            $pro_group = $row['group'];
        }

        echo $pro_name . '#' . $pro_mac . '#' . $pro_date . '#' . $pro_group;
    } else {
        mysqli_query($con, "INSERT INTO `profile` (`mac`, `ip`, `name`, `date`) VALUES ('$mac', '$ip', '$name', '$date')");
        echo "Your Account successfully created. Your profile id is " . $mac . ". Thank you ...:)  ";
    }
}

if (isset($_POST['installsoft'])) {
    $number_of_soft = "No Data";
    $update_date = "No Data";
    $drive_update_date = "No Data";
    $number_of_drive = "No Data";

    $mac = $_POST['mac'];

    $result = mysqli_query($con, "SELECT * FROM  `softwaredata` WHERE mac ='$mac'");
    $number_of_soft = mysqli_num_rows($result);
    if ($number_of_soft > 0) {
        $result2 = mysqli_query($con, "SELECT * FROM  `softwaredata` WHERE mac ='$mac' LIMIT 2 ");
        while ($row2 = mysqli_fetch_array($result2)) {
            $update_date = $row2['date'];
        }
    }

    $result3 = mysqli_query($con, "SELECT * FROM  `drivedata` WHERE type='Fixed' and mac ='$mac'");
    $number_of_drive = mysqli_num_rows($result3);
    if ($number_of_drive > 0) {
        $result4 = mysqli_query($con, "SELECT * FROM  `drivedata` WHERE mac ='$mac'");
        while ($row4 = mysqli_fetch_array($result4)) {
            $drive_update_date = $row4['date'];
        }
    }
    echo $number_of_soft . "#" . $update_date . "#" . $number_of_drive . "#" . $drive_update_date;
}
?>