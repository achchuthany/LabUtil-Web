<?php

require_once 'classes/config.php';

/**
 * Description of Online
 *
 * @author Y.ACHCHUTHAN
 * @version 1.0.0.0
 */
class online {

    //put your code here
    private $today, $x, $y, $z, $w;
    public $con;

    function __construct() {
        $connection = new config();
        $this->con = $connection->connection;
        $this->today = date("Y-m-d");
        $timeArray = explode(":", date("H:i:s"));
        $this->x = ($timeArray[0] * 60 * 60);
        $this->y = ($timeArray[1] * 60) - 2 * 60;
        $this->z = ($timeArray[2]);
        $this->w = ($this->x + $this->y + $this->z);
    }

    public function get_num_all_online() {
        $update_time = gmdate("H:i:s", $this->w);
        $result = mysqli_query($this->con, "SELECT * FROM testdata where date = '$this->today' and ( out_time  > '$update_time'or in_time >'$update_time')");
        $number_of_online = mysqli_num_rows($result);
        return $number_of_online;
    }

    public function get_num_cat_online() {
        $result_option = mysqli_query($this->con, "SELECT * FROM  `labprofile`");
        $update_time = gmdate("H:i:s", $this->w);
        while ($row_option = mysqli_fetch_array($result_option)) {
            $grop = $row_option['name'];
            $result = mysqli_query($this->con, "SELECT * FROM  `testdata` WHERE  `group` =  '$grop' AND `date`='$this->today' AND ( `out_time`  > '$update_time' OR `in_time` >'$update_time')");
            $number_of_online = mysqli_num_rows($result);
            echo '<li> <a href="?cat=' . $grop . '"> <span class="badge pull-right bg-success">' . $number_of_online . '</span> <i class="icon-list"></i> ' . $grop . '</a> </li>';
        }
    }

    public function get_shoutdown_option() {
        $result_option3 = mysqli_query($this->con, "SELECT * FROM  `labprofile`");
        while ($row_option2 = mysqli_fetch_array($result_option3)) {
            echo '<li><a href="?shutdown=' . $row_option2['name'] . '">' . $row_option2['name'] . '</a></li>';
        }
    }
    public function get_shoutdown_state(){
        $date = date("Y-m-d");
		$state = "";
        $query = mysqli_query($this->con, "SELECT * FROM  `labprofile`");
while ($row = mysqli_fetch_array($query)) {
    $group = $row['name'];
    $query2 = mysqli_query($this->con, "SELECT * FROM  `profile` WHERE `group`='$group' LIMIT 1");
    while ($row2 = mysqli_fetch_array($query2)) {
        $mac = $row2['mac'];
    }
    $query3 = mysqli_query($this->con, "SELECT * FROM  `shutdown` WHERE `mac`='$mac' and `date`='$date'");
    while ($row3 = mysqli_fetch_array($query3)) {
        $state = $row3['shutdown'];
        $date2 = $row3['date'];
    }
    echo ' <li> <a href="?">';
    if ($state == 'Activate') {
        echo '<span class="badge pull-right btn-success">';
    } else {
        echo '<span class="badge pull-right btn-danger">';
    }
    echo '<i class="icon-off"></i></span><i class="icon-list"></i> ' . $row['name'] . ' <br><p class="text-sm">update at ' . $date2 . '</p></a></li>  '
    ;
}
    }
    public function get_shoutdown_off_option() {
        $result_option3 = mysqli_query($this->con, "SELECT * FROM  `labprofile`");
        while ($row_option2 = mysqli_fetch_array($result_option3)) {
            echo '<li><a href="?stop=' . $row_option2['name'] . '">' . $row_option2['name'] . '</a></li>';
        }
    }

    public function get_list_online_computers($cat) {
        $update_time = gmdate("H:i:s", $this->w);

        $grop = $cat;
        $result = mysqli_query($this->con, "SELECT * FROM  `testdata` WHERE  `group` = '$grop' AND `date`='$this->today' AND ( `out_time`  > '$update_time'OR `in_time` >'$update_time') ORDER BY out_time DESC");


        while ($row = mysqli_fetch_array($result)) {
            $name = "null";
            $group = "null";
            $mac = $row['mac'];
            $result_name = mysqli_query($this->con, "SELECT * FROM `profile` where mac = '$mac'");
            while ($row_name = mysqli_fetch_array($result_name)) {
                $name = $row_name['name'];
                $group = $row_name['group'];
            }

            echo '<li class="list-group-item"> <a href="?shutdownThis=' . $mac . '" class="clear"> '
            . '<small class="pull-right">   
            DB Update ' . $row['out_time'] . '</small>
			    <span class="label label-sm bg-info text-uc"> '
            . $group . ' </span>  <strong>' . $name . ' / '
            . $row['user'] . '</strong> <span>   
			   is Start at ' . $row['in_time']
            . ' , Working ' . $row['on_time']
            . ' </span> </a> </li>';
        }
    }

    public function get_all_list_online_computers() {
        $update_time = gmdate("H:i:s", $this->w);


        $result = mysqli_query($this->con, "SELECT * FROM testdata where date = '$this->today' and ( out_time  > '$update_time'or in_time >'$update_time') ORDER BY out_time DESC");


        while ($row = mysqli_fetch_array($result)) {
            $name = "null";
            $group = "null";
            $mac = $row['mac'];
            $result_name = mysqli_query($this->con, "SELECT * FROM `profile` where mac = '$mac'");
            while ($row_name = mysqli_fetch_array($result_name)) {
                $name = $row_name['name'];
                $group = $row_name['group'];
            }

            echo '<li class="list-group-item"> <a href="?shutdownThis=' . $mac . '" class="clear"> '
            . '<small class="pull-right"><span class="label label-sm bg-danger text-uc"></span> '
            . 'DB Update ' . $row['out_time'] . '</small>
			    <span class="label label-sm bg-info text-uc"> '
            . $group . ' </span>  <strong>' . $name . ' / '
            . $row['user'] . '</strong> <span>   
			   is Start at ' . $row['in_time']
            . ' , Working ' . $row['on_time']
            . ' </span> </a> </li>';
        }
    }

    public function setShoutdown($group) {
        $group = $_GET['shutdown'];
        $result_name = mysqli_query($this->con, "SELECT * FROM `profile` where `group` = '$group'");
        while ($row_name = mysqli_fetch_array($result_name)) {
            $_SESSION[$row_name['mac']] = "Activate";
        }
    }

    public function stopShoutdown() {
        $result_name = mysqli_query($this->con, "SELECT * FROM `profile`");
        while ($row_name = mysqli_fetch_array($result_name)) {
            unset($_SESSION[$row_name['mac']]);
        }
    }

    public function getShoutdownPC($mac) {
        return $_SESSION[$mac];
    }

}

?>
