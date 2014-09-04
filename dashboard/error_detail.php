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


        <link type="text/css" rel="stylesheet" href="/comments/css/style.css">
        <link type="text/css" rel="stylesheet" href="/comments/css/example.css">

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
                  <a class="active" href="error_detail">
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

<?php 
// Connect to the database
include('config2.php'); 
//$id_post = "1"; //the post or the page id
?>

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
                              <!--<h5 class="pull-right">21 August 2014</h5>-->
                              <?php 
                              echo $_GET['id'];
                                  $errorDetailID = $_SESSION['orgID'];
                                  $sql = mysql_query("SELECT * FROM jserrors WHERE OrgID='$errorDetailID' ORDER BY ID DESC") or die(mysql_error());;
                                  while($affcom = mysql_fetch_assoc($sql)){ 
                                  $message = $affcom['message'];
                                  $time = $affcom['time'];
                                  $id_post = $affcom['ID'];
                              ?>

                              <div class="activity terques" id="<?php echo $id_post; ?>">
                                  <span>
                                      <i class="icon-bullhorn"></i>
                                  </span>
                                  <div class="activity-desk">
                                      <div class="panel">
                                          <div class="panel-body">
                                              <div class="arrow"></div>
                                              <i class=" icon-time"></i>
                                              <h4><?php echo $time; ?></h4>
                                              <p><?php echo $message; ?></p>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                              <?php } ?>


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

                              <?php 
                                  $sql = mysql_query("SELECT * FROM comments WHERE id_post = '$id_post'") or die(mysql_error());;
                                  while($affcom = mysql_fetch_assoc($sql)){ 
                                  $name = $affcom['name'];
                                  $email = $affcom['email'];
                                  $comment = $affcom['comment'];
                                  $date = $affcom['date'];

                                  // Get gravatar Image 
                                  // https://fr.gravatar.com/site/implement/images/php/
                                  $default = "mm";
                                  $size = 35;
                                  $grav_url = "http://www.gravatar.com/avatar/".md5(strtolower(trim($email)))."?d=".$default."&s=".$size;

                              ?>

                                  <!-- Comment -->
                                  <div class="msg-time-chat">
                                      <a class="message-img" href="#"><img alt="" src="<?php echo $grav_url; ?>" class="avatar"></a>
                                      <div class="message-body msg-in">
                                          <span class="arrow"></span>
                                          <div class="text">
                                              <p class="attribution"><a href="#"><?php echo $name; ?></a> at <?php echo $date; ?></p>
                                              <p>
                                                <i class="icon-star"></i>
                                                <i class="icon-star-empty"></i>
                                                <i class="icon-star-empty"></i>
                                                <i class="icon-star-empty"></i>
                                                <i class="icon-star-empty"></i>
                                              </p>
                                              <p><?php echo $comment; ?></p>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- /comment -->

                              <?php } ?>

                              </div>
                              <div class="chat-form">
                              <!--
                                  <div class="input-cont ">
                                      <input type="text" placeholder="Type a message here..." class="form-control col-lg-12">
                                  </div>
                                  -->

    <div class="new-com-bt">
        <span>Write a comment ...</span>
    </div>
    <div class="new-com-cnt">
        <input type="hidden" id="name-com" name="name-com" value="<?php echo $_SESSION['username']; ?>" />
        <input type="hidden" id="mail-com" name="mail-com" value="<?php echo $_SESSION['email']; ?>" />
        <textarea class="the-new-com"></textarea>
        <div class="bt-add-com btn btn-danger">Post comment</div>
        <div class="bt-cancel-com">Cancel</div>
    </div>
    <div class="clear"></div>


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

<script type="text/javascript">
   $(function(){ 
        //alert(event.timeStamp);
        $('.new-com-bt').click(function(event){    
            $(this).hide();
            $('.new-com-cnt').show();
            $('#name-com').focus();
        });

        /* when start writing the comment activate the "add" button */
        $('.the-new-com').bind('input propertychange', function() {
           $(".bt-add-com").css({opacity:0.6});
           var checklength = $(this).val().length;
           if(checklength){ $(".bt-add-com").css({opacity:1}); }
        });

        /* on clic  on the cancel button */
        $('.bt-cancel-com').click(function(){
            $('.the-new-com').val('');
            $('.new-com-cnt').fadeOut('fast', function(){
                $('.new-com-bt').fadeIn('fast');
            });
        });

        // on post comment click 
        $('.bt-add-com').click(function(){
            var theCom = $('.the-new-com');
            var theName = $('#name-com');
            var theMail = $('#mail-com');

            if( !theCom.val()){ 
                alert('You need to write a comment!'); 
            }else{ 
                $.ajax({
                    type: "POST",
                    url: "ajax/add-comment.php",
                    data: 'act=add-com&id_post='+<?php echo $id_post; ?>+'&name='+theName.val()+'&email='+theMail.val()+'&comment='+theCom.val(),
                    success: function(html){
                        theCom.val('');
                        theMail.val('');
                        theName.val('');
                        $('.new-com-cnt').hide('fast', function(){
                            $('.new-com-bt').show('fast');
                            $('.new-com-bt').before(html);  
                        })
                    }  
                });
            }
        });

    });
</script>


  </body>
</html>
