<?php
session_start();
extract($_POST);
if($_POST['act'] == 'add-com'):
	$name = htmlentities($name);
    $email = htmlentities($email);
    $comment = htmlentities($comment);

    // Connect to the database
	include('../config2.php'); 
	$name=$_SESSION['username'];
	$email=$_SESSION['email'];
	// Get gravatar Image 
	// https://fr.gravatar.com/site/implement/images/php/
	$default = "mm";
	$size = 35;
	$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . $default . "&s=" . $size;
	date_default_timezone_set('America/Los_Angeles');
	if(strlen($name) <= '1'){ $name = 'Guest';}
    //insert the comment in the database
    mysql_query("INSERT INTO comments (name, email, comment, id_post)VALUES( '$name', '$email', '$comment', '$id_post')");
    if(!mysql_errno()){
?>

    <div class="cmt-cnt">
    	<img src="<?php echo $grav_url; ?>" alt="" />
		<div class="thecom">
	        <h5><?php echo $name; ?></h5><span  class="com-dt"><?php echo date('d-m-Y H:i'); ?></span>
	        <br/>
	       	<p><?php echo $comment; ?></p>
          <?php 
            if($_SESSION['admin'] == 1)
            {
          ?>
              <div class="bt-rm-com pull-right" id="<?php echo $id_post; ?>">
                <a href="javascript:;"><i class="icon-remove"></i></a>
              </div>
          <?php 
           }
          ?>
          
	    </div>
	</div><!-- end "cmt-cnt" -->

	<?php } ?>
<?php endif; ?>