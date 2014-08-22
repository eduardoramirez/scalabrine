<?php
   session_start();
   if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
      header("Location: /dashboard/login.php");
   }
   else
   {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="error details">

    <title>scalabrine | error detail</title>

    <link rel="icon" href="/img/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap core CSS -->
    <link href="/dashboard/css/bootstrap.min.css" rel="stylesheet">
    <link href="/dashboard/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="/dashboard/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

      <!-- Custom styles for this template -->
    <link href="/dashboard/css/style.css" rel="stylesheet">
    <link href="/dashboard/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
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
         <a href="index.html" class="logo"><span>scalabrine</span></a>
         <!--logo end-->

         <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <a>
               <i class="icon-bell-alt"></i>
               last logged in: <?php echo $_SESSION['time'] ?>
            </a>
         </div>

         <div class="top-nav ">
            <!--search & user info start-->
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
                     <li><a href="/dashboard/logout.php"><i class="icon-key"></i> Log Out</a></li>
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
                  <a href="index.php">
                     <i class="icon-dashboard"></i>
                     <span>dashboard</span>
                  </a>
               </li>

               <li>
                  <a class="active" href="error_detail.php">
                     <i class="icon-tasks"></i>
                     <span>error details</span>
                  </a>
               </li>

               <li>
                  <a href="/index.html">
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
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-6">
                      <div class="panel">
                          <header class="panel-heading">
                              Error Incidents Occurred
                              <span class="tools pull-right">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                          </header>
                          <div class="panel-body profile-activity">
                              <h5 class="pull-right">21 August 2014</h5>
                              <div class="activity terques">
                                  <span>
                                      <i class="icon-bullhorn"></i>
                                  </span>
                                  <div class="activity-desk">
                                      <div class="panel">
                                          <div class="panel-body">
                                              <div class="arrow"></div>
                                              <i class=" icon-time"></i>
                                              <h4>10:00 AM</h4>
                                              <p>Everyone likes to qq for no reason.</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="activity alt purple">
                                  <span>
                                      <i class="icon-bullhorn"></i>
                                  </span>
                                  <div class="activity-desk">
                                      <div class="panel">
                                          <div class="panel-body">
                                              <div class="arrow-alt"></div>
                                              <i class=" icon-time"></i>
                                              <h4>12:21 PM</h4>
                                              <p>trololol more problems</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="activity blue">
                                  <span>
                                      <i class="icon-bullhorn"></i>
                                  </span>
                                  <div class="activity-desk">
                                      <div class="panel">
                                          <div class="panel-body">
                                              <div class="arrow"></div>
                                              <i class=" icon-time"></i>
                                              <h4>13:11 PM</h4>
                                              <p>System crashed. Report #1337.</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <div class="activity alt green">
                                  <span>
                                      <i class="icon-bullhorn"></i>
                                  </span>
                                  <div class="activity-desk">
                                      <div class="panel">
                                          <div class="panel-body">
                                              <div class="arrow-alt"></div>
                                              <i class=" icon-time"></i>
                                              <h4>14:04 PM</h4>
                                              <p>gg.</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="panel">
                          <header class="panel-heading">
                              Comments
                              <span class="tools pull-right">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                                <a href="javascript:;" class="icon-remove"></a>
                            </span>
                          </header>
                          <div class="panel-body">
                              <div class="timeline-messages">
                                  <!-- Comment -->
                                  <div class="msg-time-chat">
                                      <a class="message-img" href="#"><img alt="" src="img/alvin.png" class="avatar"></a>
                                      <div class="message-body msg-in">
                                          <span class="arrow"></span>
                                          <div class="text">
                                              <p class="attribution"><a href="#">Alvin See</a> at 1:05pm, 21 August 2014</p>
                                              <p>
                                                <i class="icon-star"></i>
                                                <i class="icon-star-empty"></i>
                                                <i class="icon-star-empty"></i>
                                                <i class="icon-star-empty"></i>
                                                <i class="icon-star-empty"></i>
                                              </p>
                                              <p>Why does everyone like to qq so much.</p>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- /comment -->

                                  <!-- Comment -->
                                  <div class="msg-time-chat">
                                      <a class="message-img" href="#"><img alt="" src="img/ed.png" class="avatar"></a>
                                      <div class="message-body msg-out">
                                          <span class="arrow"></span>
                                          <div class="text">
                                              <p class="attribution"> <a href="#">Eduardo Ramirez</a> at 2:03pm, 21 August 2014</p>
                                              <p>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star-empty"></i>
                                                <i class="icon-star-empty"></i>
                                              </p>
                                              <p>Leave me alone</p>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- /comment -->

                                  <!-- Comment -->
                                  <div class="msg-time-chat">
                                      <a class="message-img" href="#"><img alt="" src="img/slava.png" class="avatar"></a>
                                      <div class="message-body msg-in">
                                          <span class="arrow"></span>
                                          <div class="text">
                                              <p class="attribution"><a href="#">Slava Gadetskiy</a> at 2:09pm, 21 August 2014</p>
                                              <p>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                              </p>                                              
                                              <p>lol.</p>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- /comment -->

                                  <!-- Comment -->
                                  <div class="msg-time-chat">
                                      <a class="message-img" href="#"><img alt="" src="img/ken.png" class="avatar"></a>
                                      <div class="message-body msg-out">
                                          <span class="arrow"></span>
                                          <div class="text">
                                              <p class="attribution"><a href="#">Kenny Mai</a> at 3:05pm, 21 August 2014</p>
                                              <p>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star-empty"></i>
                                                <i class="icon-star-empty"></i>
                                                <i class="icon-star-empty"></i>
                                              </p>                                              
                                              <p>Asian power.</p>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- /comment -->
                                  <!-- Comment -->
                                  <div class="msg-time-chat">
                                      <a class="message-img" href="#"><img alt="" src="img/matt.png" class="avatar"></a>
                                      <div class="message-body msg-in">
                                          <span class="arrow"></span>
                                          <div class="text">
                                              <p class="attribution"><a href="#">Matt Asaro</a> at 3:55pm, 21 August 2014</p>
                                              <p>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star"></i>
                                                <i class="icon-star-empty"></i>
                                              </p>                                              
                                              <p>White power.</p>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- /comment -->
                              </div>
                              <div class="chat-form">
                                  <div class="input-cont ">
                                      <input type="text" placeholder="Type a message here..." class="form-control col-lg-12">
                                  </div>
                                  <div class="form-group">
                                      <div class="pull-right chat-features">
                                          <a href="javascript:;">
                                              <i class="icon-camera"></i>
                                          </a>
                                          <a href="javascript:;">
                                            <i class="icon-star-empty"></i>
                                            <i class="icon-star-empty"></i>
                                            <i class="icon-star-empty"></i>
                                            <i class="icon-star-empty"></i>
                                            <i class="icon-star-empty"></i>
                                          </a>
                                          <a href="javascript:;" class="btn btn-danger">Send</a>
                                      </div>
                                  </div>

                              </div>
                          </div>
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
    <script src="/dashboard/js/jquery.js"></script>
    <script src="/dashboard/js/bootstrap.min.js"></script>
    <script src="/dashboard/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="/dashboard/js/jquery.scrollTo.min.js"></script>
    <script src="/dashboard/js/jquery.nicescroll.js"></script>
    <script src="/dashboard/js/respond.min.js" ></script>

    <!--common script for all pages-->
    <script src="/dashboard/js/common-scripts.js"></script>

  </body>
</html>
