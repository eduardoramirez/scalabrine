<?php 	
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
  session_start();
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$emailError = null;
		$passwordError = null;
		
		// keep track post values
		$name = $_POST['name'];
		$email = $_POST['email'];
	  $level = $_POST['level'];
    $password = $_POST['password'];

		$options = [
    	'cost' => 11,
      'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    ];

		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Username';
			$valid = false;
		}
		
		if (empty($email)) {
			$emailError = 'Please enter Email Address';
			$valid = false;
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$emailError = 'Please enter a valid Email Address';
			$valid = false;
		}
		
		
//////////
    //$numRows = getNumRows('s', array($name), "SELECT username FROM user WHERE username=?");

    //$numRows1 = getNumRows('s', array($email), "SELECT username FROM user WHERE email=?");

    //$db_result = my_query('i', array($id), "SELECT username, email FROM user where ID = ?");

    if($valid)
    {
      // Username is free
      if(($numRows == 0 && $numRows1 == 0) || (strcmp($name, $db_result['Username']) == 0 && strcmp($email, $db_result['Email']) == 0)) 
      {
        if(isset($_POST['password']))
        {
          $h_password = password_hash($password, PASSWORD_BCRYPT, $options);
        }

        if ($_SESSION['admin'] == 1) 
        {
          $params = array($name, $email, $h_password, $level, $id);
          $sql = "UPDATE user set Username = '$name', Email = '$email', Password = '$h_password', admin = '$level' WHERE ID = '$id'";
          my_query('sssii', $params, $sql);
        } 
        else {
          $params = array($name, $email, $h_password, $level);
          $sql = "UPDATE user set Username = '$name', Email = '$email', Password = '$h_password' WHERE ID = '$id'";
          my_query('sssi', $params, $sql);
        }

        $_SESSION['crud_update_success'] = true;
      }
      else
      {
        //username is taken
        $_SESSION['crud_update_already_username'] = true;
      }
    }

	} else {
    function my_query($type, $param, $query)
{
  $SQL = $con->prepare($query);
  call_user_func_array(array($SQL, "bind_param"), array_merge(array($type), $param));
  $SQL->execute();
  $SQL->store_result();
  $results = $SQL->fetch_assoc();
  $SQL->free();
  $SQL->close();

  return $results;
}

    data = my_query('i', array(&$id), "SELECT * FROM user where ID = ?");
		//$name = $data['Username'];
		//$email = $data['Email'];
    //$h_password = $data['Password'];
    //$level = $data['admin'];
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="dashboard">

      <title>scalabrine | update</title>

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
                  <a href="/jserrorreporter">
                     <i class="icon-exclamation"></i>
                     <span>error reporter</span>
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
    
        <?php
            if($_SESSION['crud_update_already_username'] == true)
            {
              $_SESSION['crud_update_already_username'] = false;
        ?>
            <div class="alert alert-info" role="alert">username/email already taken</div>    
        <?php
            }
            if($_SESSION['crud_update_success'] == true)
            {
              $_SESSION['crud_update_success'] = false;
        ?>
            <div class="alert alert-info" role="alert">successful update</div>    
        <?php
            }
        ?>


    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Update a User</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="update?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Username</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="Username" value="<?php echo !empty($name)?$name:'';?>">
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
					      	<input name="password" type="password"  placeholder="Password">
					    </div>
                      </div>
                      <?php if($_SESSION['admin']==1): ?>
					  <div class="control-group">
					    <label class="control-label">Level</label>
					    <div class="controls">
                            <select class="form-control" name="level">
                                 <option value="0">user</option>
                                 <option value="1">admin</option>
                            </select>
					    </div>
					  </div>
                      <?php endif;?>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="index">Back</a>
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
