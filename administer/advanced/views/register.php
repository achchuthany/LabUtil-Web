<?php
include_once '../common.php';
include_once '../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $lang['PAGE_TITLE'];?></title>
<meta name="description" content="<?php echo $lang['PAGE_DESCRIPTION']; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="../css/app.v1.css">
<link rel="stylesheet" href="../css/font.css" cache="false">
<!--[if lt IE 9]> <script src="js/ie/respond.min.js" cache="false"></script> <script src="js/ie/html5.js" cache="false"></script> <script src="js/ie/fix.js" cache="false"></script> <![endif]-->
</head>
<body class="bg-light lter">
<section id="content" class="m-t-lg  wrapper-md animated fadeInDown"> <a class="nav-brand" href="index.php"><?php echo $lang['SITE_NAME']; ?></a>
  <div class="row m-n">
    <div class="col-md-4 col-md-offset-4 m-t-lg">
      <section class="panel">
        <header class="panel-heading bg bg-black text-center"> Sign up </header>

<?php
// include html header and display php-login message/error
include('header.php');

// show negative messages
if ($login->errors) {
    foreach ($login->errors as $error) {
        echo '<header class="panel-heading bg bg-danger text-center">'.$error.'</header>';
    }
}

// show positive messages
if ($login->messages) {
    foreach ($login->messages as $message) {
	 echo '<header class="panel-heading bg bg-info text-center">'.$message.'</header>';
    }
}
// show negative messages
if ($registration->errors) {
    foreach ($registration->errors as $error) {
       echo '<header class="panel-heading bg bg-danger text-center">'.$error.'</header>';
    }
}

// show positive messages
if ($registration->messages) {
    foreach ($registration->messages as $message) {
       echo '<header class="panel-heading bg bg-info text-center">'.$message.'</header>';
    }
}

// show register form
// - the user name input field uses a HTML5 pattern check
// - the email input field uses a HTML5 email type check
if (!$registration->registration_successful && !$registration->verification_successful) { ?>

<form method="post" class="panel-body" action="register.php" name="registerform" data-validate="parsley"> 
<div class="form-group">  
	<label for="user_name"><?php echo $phplogin_lang['Register username']; ?></label>
	<input class="form-control" id="user_name" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" data-required="true"/>
 </div>
<div class="form-group">
	<label for="user_email" class="control-label"><?php echo $phplogin_lang['Register email']; ?></label>
	<input class="form-control" id="user_email" type="email" name="user_email" data-required="true"/>
</div>
<div class="form-group">
	<label for="user_password_new" class="control-label"><?php echo $phplogin_lang['Register password']; ?></label>
	<input class="form-control" id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" data-required="true" autocomplete="off"/>  
 </div>
<div class="form-group" class="control-label">
	<label for="user_password_repeat"><?php echo $phplogin_lang['Register password repeat']; ?></label>
	<input class="form-control" id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" data-required="true" autocomplete="off"/>        
<div class="form-group">
	<img src="tools/showCaptcha.php" alt="captcha" />

	<label class="control-label"><?php echo $phplogin_lang['Register captcha']; ?></label>
	<input class="form-control" type="text" name="captcha" data-required="true"/>
</div>
	<input type="submit" class="btn btn-danger" name="register" value="<?php echo $phplogin_lang['Register']; ?>"/>
</form>
<?php } ?>

 <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Already have an account?</small></p>
          <a href="index.php" class="btn btn-success btn-block">Sign in</a>


</section>
    </div>
  </div>
</section>
<!-- footer -->
<footer id="footer">
  <div class="text-center padder clearfix">
    <p> <small>Group No. 7 ,University of Jaffna &copy; <?php echo date("Y");?></small> </p>
  </div>
</footer>
<!-- / footer --><script src="../css/app.v1.js"></script> <!-- Bootstrap --> <!-- app -->
</body>
</html>
