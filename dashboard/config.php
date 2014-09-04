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
    <meta name="description" content="error tracking script">

    <title>scalabrine | error tracking script</title>

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
               <br>
               <i class="icon-envelope"></i>
               current user's email: <?php echo $_SESSION['email'] ?>
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
                  <a href="index">
                     <i class="icon-dashboard"></i>
                     <span>dashboard</span>
                  </a>
               </li>

               <li>
                  <a href="error_detail">
                     <i class="icon-tasks"></i>
                     <span>error details</span>
                  </a>
               </li>

               <li>
                  <a href="/crud/index">
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
                  <a class="active" href="/dashboard/config">
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
      <div id="main-content">
      
      <!-- Main -->
      <div class="wrapper">
         <?php echo 
'/* object literal wrapper to avoid namespace conflicts */
var ErrorTracking = {};


/* URL of your server-side error recording script */
ErrorTracking.errorReportingURL = "http://104.131.195.41:9091/seterrors.php";



ErrorTracking.encodeValue = function(val)
{

  var encodedVal;

  if (!encodeURIComponent)
  {
    encodedVal = escape(val);

    /* fix the omissions */
    encodedVal = encodedVal.replace(/@/g, \'%40\');

    encodedVal = encodedVal.replace(/\//g, \'%2F\');

    encodedVal = encodedVal.replace(/\+/g, \'%2B\');
  }
  else
  {
    encodedVal = encodeURIComponent(val);

    /* fix the omissions */
    encodedVal = encodedVal.replace(/~/g, \'%7E\');

    encodedVal = encodedVal.replace(/!/g, \'%21\');

    encodedVal = encodedVal.replace(/\(/g, \'%28\');

    encodedVal = encodedVal.replace(/\)/g, \'%29\');

    encodedVal = encodedVal.replace(/\'/g, \'%27\');
  }

 /* clean up the spaces and return */
 return encodedVal.replace(/\%20/g,\'+\'); 
} 


ErrorTracking.reportJSError = function (errorMessage,url,lineNumber)
{
  function sendRequest(url,payload)
  {
    var img = new Image();

    img.src = url+"?"+payload;
  }

  /* form payload string with error data */
  var payload = "url=" + ErrorTracking.encodeValue(url);

  payload += "&message=" + ErrorTracking.encodeValue(errorMessage);

  payload += "&line=" + ErrorTracking.encodeValue(lineNumber);

  payload += "&orgID="'.echo $_SESSION['orgID'];.'

  /* submit error message  */
  sendRequest(ErrorTracking.errorReportingURL,payload);

  alert("JavaScript Error Encountered.  \nSite Administrators have been notified.");

  return true; // suppress normal JS errors since we handled
}



ErrorTracking.registerErrorHandler = function () 
{ 
  if (window.onerror) // then one exists
  {
    var oldError = window.onerror;

    var newErrorHandler = function (errorMessage, url, lineNumber){ 
      ErrorTracking.reportJSError(errorMessage,url,lineNumber); 
      oldError(errorMessage,url,lineNumber); 
    }

    window.onerror = newErrorHandler;
  } 
  else   
    window.onerror = ErrorTracking.reportJSError;
}

/* bind the error handler */
ErrorTracking.registerErrorHandler();'
?>
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



      
