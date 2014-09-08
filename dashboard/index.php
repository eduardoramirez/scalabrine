<?php
   session_start();
   if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
      header("Location: /dashboard/login");
   }
   else
   {
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="dashboard">

      <title>scalabrine | dashboard</title>

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
                  <a class="active" href="/dashboard/index">
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
                  <a href="/crud/index">
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
<!--               
               <li>
                  <a href="/index">
                     <i class="icon-user"></i>
                     <span>home</span>
                  </a>
               </li>
-->
            </ul>
            <!-- sidebar menu end-->
         </div>
      </aside>
      <!--sidebar end-->
      
      <!--main content start-->
      <div id="main-content">
         <div class="wrapper">

            <div class="row">
            <!--row start-->
               <div class="col-lg-4">
                  <!--traffic start-->
                  <div class="panel terques-chart">
                     <div class="panel-body chart-texture">
                        <div class="chart">
                           <div class="heading">
                              <span>Thursday</span>
                              <strong>1337%</strong>
                           </div>
                           <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,564,455]"></div>
                        </div>
                     </div>
                     <div class="chart-tittle">
                        <span class="title">Monthly Traffic</span>
                     </div>
                  </div>
                  <!--traffic end-->
               </div>
              
               <div class="col-lg-4">
                  <!--chart start-->
                  <div class="panel">
                     <div class="revenue-head">
                        <span>
                           <i class="icon-bar-chart"></i>
                        </span>
                        <h3>Types of Errors</h3>
                        <span class="rev-combo pull-right">
                           August 2014
                        </span>
                     </div>
                     <div class="panel-body">
                        <div class="col-lg-6 col-sm-6 text-center">
                           <div class="chart">
                              <div id="pie-chart" ></div>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
            <!--row end-->
            </div>

            <div class="panel">
               <header class="panel-heading">
                  Errors
               </header>
               <div class="panel-body">
                  <div class="adv-table">
                     <table class="display table table-bordered" id="hidden-table-info">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>User Agent</th>
                              <th>URL</th>
                              <th>Line Number</th>
                              <th>Message</th>
                              <th>Client IP</th>
                              <th>Time</th>
                           </tr>
                        </thead>
                        <tbody>
                    <?php 
                        require("../database.php");
                        $errorOrgID=$_SESSION['orgID'];
                        $sql = "SELECT * FROM jserrors WHERE OrgID='$errorOrgID' ORDER BY ID DESC";
   
                        foreach ($con->query($sql) as $row) {         
                           echo '<tr>';
                           echo '<td>'. $row['ID'] .'</td>';
                           echo '<td>'. $row['userAgent'] .'</td>';
                           echo '<td>'. $row['url'] .'</td>';
                           echo '<td>'. $row['line'] .'</td>';
                           echo '<td>'. $row['message'] .'</td>';
                           echo '<td>'. $row['userIP'] .'</td>';
                           echo '<td>'. $row['time'] .'</td>';
                           echo '</tr>';
                              
                        }
                        my_disconnect();
                     ?>                       
                     </tbody>
                     </table>

                  </div>
               </div>
            </div>
            <!-- page end-->
         </div>
      </div>
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

   <!--script for this page-->
   <script src="/dashboard/js/sparkline-chart.js"></script>

   <script>
      /* Formating function for row details */
      function fnFormatDetails ( oTable, nTr )
      {
         var aData = oTable.fnGetData( nTr );
         var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
         sOut += '<tr><td>Error Detail URL:</td><td><a href="/dashboard/error_detail?id='+aData[1]+'">dashboard/error_detail?id='+aData[1]+'</a></td></tr>';
         sOut += '<tr><td>User Agent:</td><td>'+aData[2]+'</td></tr>';
         sOut += '<tr><td>Origin:</td><td>'+aData[3]+'</td></tr>';
         sOut += '<tr><td>Line Number:</td><td>'+aData[4]+'</td></tr>';
         sOut += '<tr><td>Message:</td><td>'+aData[5]+'</td></tr>';
         sOut += '<tr><td>Client IP:</td><td>'+aData[6]+'</td></tr>';
         sOut += '<tr><td>Time:</td><td>'+aData[7]+'</td></tr>';
         sOut += '</table>';

         return sOut;
      }

      $(document).ready(function() {

         var nCloneTh = document.createElement( 'th' );
         var nCloneTd = document.createElement( 'td' );
         nCloneTd.innerHTML = '<img src="/dashboard/assets/advanced-datatable/examples/examples_support/details_open.png">';
         nCloneTd.className = "center";

         $('#hidden-table-info thead tr').each( function () {
            this.insertBefore( nCloneTh, this.childNodes[0] );
         } );

         $('#hidden-table-info tbody tr').each( function () {
            this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
         } );

         var oTable = $('#hidden-table-info').dataTable( {
            "aoColumnDefs": [
               { "bSortable": false, "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']]
         });

         $('#hidden-table-info tbody td img').live('click', function () {
            var nTr = $(this).parents('tr')[0];
            if ( oTable.fnIsOpen(nTr) )
            {
               /* This row is already open - close it */
               this.src = "/dashboard/assets/advanced-datatable/examples/examples_support/details_open.png";
               oTable.fnClose( nTr );
            }
            else
            {
               /* Open this row */
               this.src = "/dashboard/assets/advanced-datatable/examples/examples_support/details_close.png";
               oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
            }
         } );
      } );
   </script>

   </body>
</html>
