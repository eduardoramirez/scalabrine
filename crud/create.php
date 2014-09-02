<?php
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    header("Location: /dashboard/login");
}
else{
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$emailError = null;
		$passwordError = null;
		
		// keep track post values
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
        $orgID = $_SESSION['orgID'];

		$options = [
      		'cost' => 11,
      		'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    	];

		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Name';
			$valid = false;
		}
		
		if (empty($email)) {
			$emailError = 'Please enter Email Address';
			$valid = false;
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$emailError = 'Please enter a valid Email Address';
			$valid = false;
		}
		
		if (empty($password)) {
			$passwordError = 'Please enter Password';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$h_password = password_hash($password, PASSWORD_BCRYPT, $options);
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO user (Username,Password,Email,OrgID) values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$h_password,$email,$orgID));
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="dashboard">

      <title>scalabrine | create</title>

      <link rel="icon" href="/img/favicon.ico" type="image/x-icon" />
      <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
      <!-- Bootstrap core CSS -->
      <link href="/crud/css/bootstrap.min.css" rel="stylesheet">
      <link href="/dashboard/css/bootstrap-reset.css" rel="stylesheet">
      <!--external css-->
      <link href="/dashboard/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

      <!-- Custom styles for this template -->
      <link href="/dashboard/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />    
      <link href="/dashboard/css/style.css" rel="stylesheet">
      <link href="/dashboard/css/style-responsive.css" rel="stylesheet" />


      <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
      <!--[if lt IE 9]>
         <script src="/login/js/html5shiv.js"></script>
         <script src="/login/js/respond.min.js"></script>
      <![endif]-->  
</head>

<body>

   <div id="container" >

      <!--header start-->
      <header class="header white-bg">
         <div class="sidebar-toggle-box">
            <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
         </div>
         <!--logo start-->
         <a href="/dashboard/index" class="logo"><span>scalabrine</span></a>
         <!--logo end-->

         <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <a>
               <i class="icon-bell-alt"></i>
               last logged in: <?php echo $_SESSION['time'] ?>
               <br>
               <i class="icon-envelope"></i>
               current user's email: <?php echo $_SESSION['email'] ?>
            </a>
         </div>

         <div class="top-nav ">
            <!--user start-->
            
            <ul class="nav pull-right top-menu">
               
               <!-- user login dropdown start-->
               <li class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                     <img alt="" src="/dashboard/img/user.png" />
                     <span class="username"><?php echo $_SESSION['username'] ?></span>
                     <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu extended logout">
                     <li class="log-arrow-up"></li>
                     <li><a href="#"><i class="icon-cog"></i> Settings</a></li>
                     <li><a href="/dashboard/logout"><i class="icon-key"></i> Log Out</a></li>
                  </ul>
               </li>
               <!-- user login dropdown end -->
            </ul>
         </div>

      </header>
      <!--header end-->

      <!--sidebar start-->
      <aside>
         <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
               <li>
                  <a href="/dashboard/index">
                     <i class="icon-dashboard"></i>
                     <span>dashboard</span>
                  </a>
               </li>

               <li>
                  <a href="/dashboard/error_detail">
                     <i class="icon-tasks"></i>
                     <span>error details</span>
                  </a>
               </li>

               <li>
                  <a class="active" href="/crud/index">
                     <i class="icon-gear"></i>
                     <span>crud</span>
                  </a>
               </li>

               <li>
                  <a href="/index">
                     <i class="icon-user"></i>
                     <span>home</span>
                  </a>
               </li>

            </ul>
            <!-- sidebar menu end-->
         </div>
      </aside>
      <!--sidebar end-->

      <!--main content start-->
      <div id="main-content">
         <div class="wrapper">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Create a User</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="create.php" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
					    <label class="control-label">Email Address</label>
					    <div class="controls">
					      	<input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
					      	<?php if (!empty($emailError)): ?>
					      		<span class="help-inline"><?php echo $emailError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
					    <label class="control-label">Password</label>
					    <div class="controls">
					      	<input name="password" type="password"  placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
					      	<?php if (!empty($passwordError)): ?>
					      		<span class="help-inline"><?php echo $passwordError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
        </div> 
        </div>
        <!-- /container -->
          <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2014 &copy; scalabrine.
              <a href="#" class="go-top">
                  <i class="icon-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->

   <!-- js placed at the end of the document so the pages load faster -->
   <script src="/dashboard/js/jquery-1.8.3.min.js"></script>
   <script src="/dashboard/js/bootstrap.min.js"></script>
   <script src="/dashboard/js/jquery.dcjqaccordion.2.7.js"></script>
   <script src="/dashboard/js/jquery.scrollTo.min.js"></script>
   <script src="/dashboard/js/jquery.nicescroll.js"></script>
   <script src="/dashboard/js/jquery.sparkline.js"></script>
   <script src="/dashboard/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
   <script src="/dashboard/js/jquery.customSelect.min.js" ></script>
   <script src="/dashboard/js/respond.min.js" ></script>

   <!--common script for all pages-->
   <script src="/dashboard/js/common-scripts.js"></script>      
  </body>
</html>
<?php
}
?>