<?php 
  session_start();

	require '../database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM user where ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="dashboard">

      <title>scalabrine | read</title>

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
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Read a User</h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">Username</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['Username'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Email Address</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Email'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Role</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php
                                    switch($data['admin']){
                                        case 0:
                                            $role = 'User';
                                            break;
                                        case 1:
                                            $role = 'Admin';
                                            break;
                                        case 2:
                                            $role = 'Developer';
                                            break;
                                    }
                                    echo $role;
                                ?>
						    </label>
					    </div>
					  </div>
					    <div class="form-actions">
						  <a class="btn" href="index">Back</a>
					   </div>
					
					 
					</div>
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
