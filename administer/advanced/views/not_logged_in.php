<?php
include_once '../common.php';
include_once '../config.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $phplogin_lang['Log in'] . ' | ' . $lang['PAGE_TITLE']; ?></title>
        <meta name="description" content="<?php echo $lang['PAGE_DESCRIPTION']; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="../css/app.v1.css">
        <link rel="stylesheet" href="../css/font.css" cache="false">
        <!--[if lt IE 9]> <script src="js/ie/respond.min.js" cache="false"></script> <script src="js/ie/html5.js" cache="false"></script> <script src="js/ie/fix.js" cache="false"></script> <![endif]-->
    </head>
    <body>  
        <section class="hbox stretch">
            <section id="content">
                <section class="vbox bg-white">
                    <header class="header bg-white b-b">
                        <section  class="col-lg-1 "></section>
                        <section  class="col-lg-8 panel-heading"><a href="index.php"><img src="../images/favicon.ico" alt="LabUtil" class="thumb-sm avatar animated rollIn"></a></section>
                        <section  class="col-lg-2 panel-heading ">
                            <div class="nav-avatar pos-rlt"> <a href="#"  data-toggle="dropdown"> Languages : <?php echo $_SESSION['lang']; ?> <span class="caret caret-black"></span> </a>
            <ul class="dropdown-menu m-t-sm animated fadeIn">
              <span class="arrow top"></span>
             <li><a href="?lang=ta" title="தமிழ்">தமிழ்</a></li>
<li><a href="?lang=si" title="Sinhala">Sinhala</a></li>
	     <li><a href="?lang=en" title="English">English</a></li>
            </ul>
            
          </div>
                            <p class="text-white">.</p>
                        </section>
                        <section  class="col-lg-2 "></section>
                        
                    </header>
                    <section class="bg-info dker">
                        <br>
                         <br>
                          <br> <br> <br> <br> 
                          
                        <section id="content" class="col-lg-2"></section>
                        <section id="content" class="col-lg-5 ">
                            <br>
                            <p class="h4 text-black"><?PHP echo $lang['WELCOME_MESSAGE2']; ?></p>
                            <p class="text-center"> <span class="text-right"><img src="../images/main.png" align ="center" alt="LabUtil" height="199 px" ></span>
                           </p>
                             <br>
                        </section>
                        
                        <section id="content" class="col-lg-3 bg-white">

                            

                            <?php
// show negative messages
                            if ($login->errors) {
                                foreach ($login->errors as $error) {
                                    echo '<header class="panel-heading text-center bg-danger"> ' . $error . '</header>';
                                }
                            }

// show positive messages
                            if ($login->messages) {
                                foreach ($login->messages as $message) {
                                    echo '<header class="panel-heading text-center bg-success"> ' . $message . '</header>';
                                }
                            }
                            ?>

                            <form action="index.php" name="loginform" class="panel-body" method="POST" data-validate="parsley">
                                <div class="form-group ">
                                    <label class="control-label animated "><?php echo $lang['Username']; ?></label>
                                    <input id="user_name" type="text" name="user_name" class="form-control" data-required="true" />

                                </div>
                                <div class="form-group ">
                                    <label class="control-label "><?php echo $lang['Password']; ?></label>
                                    <input id="user_password" class="form-control" type="password" name="user_password" autocomplete="off" data-required="true" />


                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" /> <?php echo $lang['Remember me']; ?></label>
                                </div>
                                <a href="password_reset.php" class="pull-right m-t-xs"><small><?php echo $lang['I forgot my password']; ?></small></a>
                                <button type="submit" class="btn btn-info dker" name="login"  ><?php echo $lang['Log in']; ?></button>
                            </form>
<br><br>
                        </section>
                        <section id="content" class="col-lg-2"></section>
                    </section>

                    <footer class="bg-white">
                        <div class="text-center footer">
                            <p><a href="http://jfn-csc-rad-g7.blogspot.com/"> <?php echo $lang['footer'];?>&copy; 2013 - 2014</a>
                            </p>    </div>
                    </footer>

                </section>
            </section>
        </section>
        <script src="../css/app.v1.js">
        </script> 
        <!-- Bootstrap --> <!-- app -->
    </body>
</html>

