<?php
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    header("Location: /dashboard/login");
}
else if ($_SESSION['admin'] == 0){
    header("HTTP/1.1 403 Forbidden");
    header("Location: /403");
}
else{
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="dashboard">

    <title>scalabrine | User Management</title>

    <link rel="icon" href="/img/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap core CSS -->
    <link href="/dashboard/css/bootstrap.min.css" rel="stylesheet">
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
<!--
               <li>
                  <a href="/dashboard/error_detail">
                     <i class="icon-tasks"></i>
                     <span>error details</span>
                  </a>
               </li>
-->
               <li>
                  <a class="active" href="/crud/index">
                     <i class="icon-gear"></i>
                     <span>user management</span>
                  </a>
               </li>
               <li>
                  <a href="/jserrorreporter">
                     <i class="icon-exclamation"></i>
                     <span>error reporter</span>
                  </a>
               </li>
               <li>
                  <a href="/dashboard/config">
                     <i class="icon-file"></i>
                     <span>error tracking script</span>
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
      <div id="crud-main-content">
         <div class="wrapper">

    		<div class="row">
    			<h3>User Management</h3>
    		</div>
			<div class="row">
				<p>
					<a href="create" class="btn btn-success">Create</a>
				</p>
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Username</th>
		                  <th>Email Address</th>
                          <th>Role</th>
		                  <th>Action</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					    require '../database.php';
              if ($_SESSION['admin'] == 2){
                if ( !empty($_GET['orgID'])) {
                  $orgID = $_REQUEST['orgID'];
                  $sql = 'SELECT * FROM user where orgID = ' . $orgID . ' AND Username != ' . $_SESSION['username'] . ' ORDER BY ID DESC';
                }
                else {
                  $sql = 'SELECT * FROM user ORDER BY ID DESC';
                }
              }
              else{
                $sql = 'SELECT * FROM user WHERE OrgID = ' . $_SESSION['orgID'] . ' AND Username != ' . $_SESSION['username'] . ' ORDER BY ID DESC';
                echo $sql;
              }
	 				    foreach ($con->query($sql) as $row) {
					   		echo '<tr>';
						   	echo '<td>'. $row['Username'] . '</td>';
						   	echo '<td>'. $row['Email'] . '</td>';

                switch($row['admin']){
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
                echo '<td>'. $role . '</td>';

                echo '<td style="white-space:nowrap;">';
						   	echo '<a class="btn btn-success" href="update?id='.$row['ID'].'">Update</a>';
						   	echo '&nbsp;';
						   	echo '<a class="btn btn-danger" href="delete?id='.$row['ID'].'">Delete</a>';
						   	echo '</td>';
						   	echo '</tr>';
					    }
					  ?>
				      </tbody>
	            </table>
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
      </div>
<?php
}
?>

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
