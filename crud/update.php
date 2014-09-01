<?php 
	
    session_start();
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$emailError = null;
		$passwordError = null;
		
		// keep track post values
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
	    $level = $_POST['level'];

		$options = [
      		'cost' => 11,
      		'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    	];

		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Name';
			$valid = false;
		}
		
		if (empty($email)) {
			$emailError = 'Please enter Email Address';
			$valid = false;
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$emailError = 'Please enter a valid Email Address';
			$valid = false;
		}
		
		if (empty($password)) {
			$passwordError = 'Please enter Password';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$h_password = password_hash($password, PASSWORD_BCRYPT, $options);
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if ($_SESSION['admin'] === "1") {
                $sql = "UPDATE user set Username = ?, Email = ?, Password = ?, admin = ? WHERE ID = ?";
            } else {
                $sql = "UPDATE user set Username = ?, Email = ?, Password = ? WHERE ID = ?";
            }
			$q = $pdo->prepare($sql);
            if ($_SESSION['admin'] === "1") {
			$q->execute(array($name,$email,$h_password,$id));
            }
            else {
			$q->execute(array($name,$email,$h_password,$level,$id));
            }
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM user where ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$name = $data['Username'];
		$email = $data['Email'];
        $password = $data['Password'];
        $level = $data['admin'];
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Update a User</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
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
					      	<input name="password" type="password"  placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
					      	<?php if (!empty($passwordError)): ?>
					      		<span class="help-inline"><?php echo $passwordError;?></span>
					      	<?php endif;?>
					    </div>
                      </div>
<?php if($_SESSION['admin']==="1"): ?>
					    <label class="control-label">Level</label>
<select class="form-control" name="level">
  <option value="0">user</option>
  <option value="1">admin</option>
</select>
<?php endif;?>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
