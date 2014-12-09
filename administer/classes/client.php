<?php

include_once 'classes/config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of client
 *
 * @author Y.ACHCHUTHAN
 */
class client {

    //put your code here
    private $con;
    private $start;
    private $end;
    private $range;
    private $total;
    public function __construct() {
       
        
        $this->range=20;
        $config = new config();
        $this->con = $config->connection;
      
        if (isset($_GET["page"])) {
             $page = intval($_GET["page"]);
        } else{
            $page=1;
        }
        $calc = $this->range * $page;
       $this->start = $calc - $this->range;
       $this->end =$this->range;
    }
    public function getStart(){
        return $this->start;
    }
    public function getEnd(){
        return $this->start+$this->range;
    }
    public function getRange(){
        return $this->range;
    }
    public function getTotal(){
        return $this->total;
    }
   
    public function get_list_of_labs() {
        $result3 = mysqli_query($this->con, "SELECT * FROM  `labprofile`");
        while ($row3 = mysqli_fetch_array($result3)) {
            echo '<li><a href="?group=' . $row3['name'] . '">' . $row3['name'] . '</a></li>';
        }
    }

    public function get_list_of_pc_by_group($group) {   
         $result3 = mysqli_query($this->con, "SELECT * FROM  `profile` where `group`='$group' ");
        $this->total = mysqli_num_rows($result3);
        $result2 = mysqli_query($this->con, "SELECT * FROM  `profile` where `group`='$group' LIMIT $this->start,$this->end");
        
        while ($row = mysqli_fetch_array($result2)) {

            echo '
                <tr ><td><input type="checkbox" name="fruit[]" value="' . $row['mac'] . '"></td>
                <td>' . $row['mac'] . '</td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['ip'] . '</td>
                <td>
                <div class="btn-group">
                <button class="btn btn-white btn-xs">' . $row['group'] . '</button>
                <button class="btn bg-danger btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                <ul class="dropdown-menu">';
            $result3 = mysqli_query($this->con, "SELECT * FROM  `labprofile`");
            while ($row3 = mysqli_fetch_array($result3)) {
                echo '<li><a href="?changeGr=' . $row3['name'] . '&macID=' . $row['mac'] . '">' . $row3['name'] . '</a></li>';
            }
            echo '
                </ul></div></td>
                <td>' . $row['date'] . '</td><td >
                <a class="btn btn-primary btn-xs" href="clientprofile.php?mac=' . $row['mac'] . '">Profile <i class="icon-eye-open "></i></a></td>
                </tr>';
        }
    }
    
    public function get_lis_of_pc_by_mac($mac) {
         $result3 = mysqli_query($this->con, "SELECT * FROM  `profile` where `mac`='$mac' ");
        $this->total = mysqli_num_rows($result3);
        
        $result2 = mysqli_query($this->con, "SELECT * FROM  `profile` where `mac`='$mac'  LIMIT $this->start,$this->end");
        
        while ($row = mysqli_fetch_array($result2)) {

            echo '
               <tr ><td><input type="checkbox" name="fruit[]" value="' . $row['mac'] . '"></td>
                <td>' . $row['mac'] . '</td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['ip'] . '</td>
                <td>
                <div class="btn-group">
                <button class="btn btn-white btn-xs">' . $row['group'] . '</button>
                <button class="btn bg-danger btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                <ul class="dropdown-menu">';
            $result3 = mysqli_query($this->con, "SELECT * FROM  `labprofile`");
            while ($row3 = mysqli_fetch_array($result3)) {
                echo '<li><a href="?changeGr=' . $row3['name'] . '&macID=' . $row['mac'] . '">' . $row3['name'] . '</a></li>';
            }
            echo '
                </ul></div></td>
                <td>' . $row['date'] . '</td><td >
                <a class="btn btn-primary btn-xs"  href="clientprofile.php?mac=' . $row['mac'] . '">Profile <i class="icon-eye-open "></i></a></td>
                </tr>';
        }
    }
    
    public function get_lis_of_pc(){
        $result3 = mysqli_query($this->con, "SELECT * FROM  `profile`");
        $this->total = mysqli_num_rows($result3);
        
        $result2 = mysqli_query($this->con, "SELECT * FROM  `profile` LIMIT $this->start,$this->end");
        while ($row = mysqli_fetch_array($result2)) {

            echo '
             <tr ><td><input type="checkbox" name="fruit[]" value="' . $row['mac'] . '"></td>
                <td>' . $row['mac'] . '</td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['ip'] . '</td>
                <td>
                <div class="btn-group">
                <button class="btn btn-white btn-xs">' . $row['group'] . '</button>
                <button class="btn bg-danger btn-xs dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                <ul class="dropdown-menu">';
            $result3 = mysqli_query($this->con, "SELECT * FROM  `labprofile`");
            while ($row3 = mysqli_fetch_array($result3)) {
                echo '<li><a href="?changeGr=' . $row3['name'] . '&macID=' . $row['mac'] . '">' . $row3['name'] . '</a></li>';
            }
            echo '
                </ul></div></td>
                <td>' . $row['date'] . '</td><td>
                <a class="btn text-info btn-primary btn-xs" href="clientprofile.php?mac=' . $row['mac'] . '"> Profile <i class="icon-eye-open "></i></a></td>';
              ?>
<td><b data-toggle="popover" data-html="true" data-placement="top" 
       data-content="Are you want to Delete all information of
           <?php echo $row['name'] ?> PC  from Database Now !.<br><a href='?delete=<?php echo $row['mac']; ?>'
           class='btn btn-danger btn-xs pull-left'>YES</a>     
           <a  href='?'class='btn btn-success btn-xs pull-right' data-dismiss='popover'>No</a>" title="Delete Now ? " >
        <i class='icon icon-remove btn btn-xs btn-danger'></i> </b></td>
<?php
echo "</tr>";
        }
    }

}

?>
