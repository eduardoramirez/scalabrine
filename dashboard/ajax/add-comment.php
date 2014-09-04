<?php
session_start();
extract($_POST);
if($_POST['act'] == 'add-com'):

  // Connect to the database
  require('../../database.php');
	
  $name = sanitize($name);
  $email = sanitize($email);
  $comment = sanitize($comment);

	$name=$_SESSION['username'];
	$email=$_SESSION['email'];
	// Get gravatar Image 
	// https://fr.gravatar.com/site/implement/images/php/
	$default = "mm";
	$size = 35;
	$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . $default . "&s=" . $size;
	date_default_timezone_set('America/Los_Angeles');
	
  if(strlen($name) <= '1')
  { 
    $name = 'Guest';
  }

  //insert the comment in the database
  $sql = "INSERT INTO comments (name, email, comment, id_post) VALUES(?, ?, ?, ?)");
  
  $err = my_update('', array(&$name, &$email, &$comment, &$id_post), $sql);

  if($err)
  {
?>

    <div class="cmt-cnt">
    	<img src="<?php echo $grav_url; ?>" alt="" />
		<div class="thecom">
	        <h5><?php echo $name; ?></h5><span  class="com-dt"><?php echo date('d-m-Y H:i'); ?></span>
	        <br/>
	       	<p><?php echo $comment; ?></p>
	    </div>
	</div><!-- end "cmt-cnt" -->

<?php 
  } 
?>
<?php endif; ?>