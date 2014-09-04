<?php
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    header("Location: /dashboard/login");
}
else if ($_SESSION['admin'] != 2){
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

      <title>scalabrine | crud</title>

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
                  <a class="active" href="/admin/index">
                     <i class="icon-tasks"></i>
                     <span>clients</span>
                  </a>
               </li>

               <li>
                  <a href="/admin/audit">
                     <i class="icon-exclamation"></i>
                     <span>audit log</span>
                  </a>
               </li>
               <li>
                  <a href="/admin/stats">
                     <i class="icon-file"></i>
                     <span>stats</span>
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
    			<h3>Client Management</h3>
    		</div>
			<div class="row">
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>User</th>
                            <th>Event</th>
                            <th>Timestamp</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   require '../database.php';

                       $sql = 'SELECT u.username, a.event, a.timestamp, a.admin FROM audit a join user u
                       on a.userID = u.ID ORDER BY a.id DESC limit 25';

                      foreach ($con->query($sql) as $row) {

                          switch($row['admin']){
                              case 1:
                                  $role = 'Admin';
                                  break;
                              case 2:
                                  $role = 'Developer';
                                  break;
                              default:
                                  $role = 'User';
                                  break;
                          }

						   		echo '<tr>';
							   	echo '<td>'. $row['username'] . '</td>';
                                echo '<td>'. $role . '</td>';
                                echo '<td>'. $row['event'] . '</td>';
                                echo '<td>'. $row['timestamp'] . '</td>';
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
