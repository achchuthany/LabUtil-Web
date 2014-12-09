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
<section id="content" class="m-t-lg wrapper-md animated fadeInUp "> <a class="nav-brand" href="index.php"><?php echo $lang['SITE_NAME']; ?></a>
  <div class="row m-n">
    <div class="col-md-4 col-md-offset-4 m-t-lg">
      <section class="panel">
        <header class="panel-heading text-center bg-dark"> Password Reset </header>
		 
		<?php

// show negative messages
if ($login->errors) {
    foreach ($login->errors as $error) {
        echo '<header class="panel-heading text-center bg-danger"> '.$error.'</header>';
    }
}

// show positive messages
if ($login->messages) {
    foreach ($login->messages as $message) {
        echo '<header class="panel-heading text-center bg-info"> '.$message.'</header>';
    }
}

?>

<?php
// include html header and display php-login message/error
// the user just came to our page by the URL provided in the password-reset-mail
// and all data is valid, so we show the type-your-new-password form
if ($login->passwordResetLinkIsValid() == true) {
?>             
<form method="post" action="password_reset.php" name="new_password_form" data-validate="parsley">
<div class="form-group">
	<input type='hidden' name='user_name' value='<?php echo $_GET['user_name']; ?>' />
	<input class="form-control" type='hidden' name='user_password_reset_hash' value='<?php echo $_GET['verification_code']; ?>' />
	</div>
<div class="form-group">
	<label class="control-label" for="user_password_new"><?php echo $phplogin_lang['New password']; ?></label>
	<input class="form-control" id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" data-required="true" autocomplete="off" />
	</div>
<div class="form-group">
	<label class="control-label" for="user_password_repeat"><?php echo $phplogin_lang['Repeat new password']; ?></label>
	<input class="form-control" id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" data-required="true" autocomplete="off" />
</div>	
	<input type="submit" class="btn btn-danger" name="submit_new_password" value="<?php echo $phplogin_lang['Submit new password']; ?>" />
	<div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Already have an account?</small></p>
          <a href="index.php" class="btn btn-success btn-block">Sign in</a>
</form>
<?php
// no data from a password-reset-mail has been provided, so we simply show the request-a-password-reset form
} else {
?>
<form method="post" class="panel-body"  action="password_reset.php" name="password_reset_form" data-validate="parsley">
<div class="form-group">
	<label class="control-label" for="user_name"><?php echo $phplogin_lang['Password reset request']; ?></label>
	<input class="form-control" id="user_name" type="text" name="user_name" data-required="true" />
</div>
	<input type="submit" class="btn btn-danger" name="request_password_reset" value="<?php echo $phplogin_lang['Reset my password']; ?>" />
	<div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Already have an account?</small></p>
          <a href="index.php" class="btn btn-success btn-block">Sign in</a>
</form>
<?php
}
?>

</section>
    </div>
  </div>
</section>
<!-- footer -->
<footer id="footer">
  <div class="text-center padder clearfix">
    <p> <small>Group No. 7 , University of Jaffna
      &copy; 2013</small> </p>
  </div>
</footer>
<!-- / footer --><script src="../css/app.v1.js">
   </script> 
<!-- Bootstrap --> <!-- app -->
</body>
</html>

