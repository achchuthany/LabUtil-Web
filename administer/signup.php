<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sign up | LABS UTIL</title>
<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="css/app.v1.css">
<link rel="stylesheet" href="css/font.css" cache="false">
<!--[if lt IE 9]> <script src="js/ie/respond.min.js" cache="false"></script> <script src="js/ie/html5.js" cache="false"></script> <script src="js/ie/fix.js" cache="false"></script> <![endif]-->
</head>
<body>
<section id="content" class="m-t-lg wrapper-md animated fadeInDown"> <a class="nav-brand" href="index.html">LABS UTIL</a>
  <div class="row m-n">
    <div class="col-md-4 col-md-offset-4 m-t-lg">
      <section class="panel">
        <header class="panel-heading bg bg-primary text-center"> Sign up </header>
        <form action="class/signup.php" class="panel-body" method="POST" data-validate="parsley">
          <div class="form-group">
            <label class="control-label">Display name</label>
            <input type="text" name="username" placeholder="eg. Your name" class="form-control" data-required="true">
          </div>
          <div class="form-group">
            <label class="control-label">Your email address</label>
            <input type="email" name="email" placeholder="achchuthan@uojonline.net" class="form-control" data-required="true">
          </div>
          <div class="form-group">
            <label class="control-label" >Type a password</label>
            <input type="password" name="password" id="inputPassword" placeholder="Password" class="form-control" data-required="true">
          </div>
          <div class="checkbox" >
            <label>
              <input type="checkbox" data-required="true">
              Agree the <a href="#">terms and policy</a> </label>
          </div>
          <button type="submit" class="btn btn-info">Sign up</button>
          <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Already have an account?</small></p>
          <a href="signin.php" class="btn btn-white btn-block">Sign in</a>
        </form>
		
		 
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
<!-- / footer --><script src="css/app.v1.js"></script> <!-- Bootstrap --> <!-- app -->
</body>
</html>