<?php
session_start();

$id = 0;
if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    header("Location: /dashboard/login");
}
else if ($_SESSION['admin'] == 0 || empty($_GET['id'])){
    header("HTTP/1.1 403 Forbidden");
    header("Location: /403");
}
else if ($_SESSION['admin'] == 1){
    $orgID = $_SESSION['orgID'];

    $sql = 'SELECT count(*) FROM user WHERE ID = ' . $id . ' and OrgID = ' . $_SESSION['orgID'];
    $pdo = Database::connect();
    $result = $pdo->query($sql);

    echo $result;

    if ($result == 0){
        header("HTTP/1.1 403 Forbidden");
        header("Location: /403");
    }
    else{
        require 'database.php';

        if ( !empty($_POST)) {
            // keep track post values
            $id = $_POST['id'];

            // delete data
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM user WHERE ID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
            Database::disconnect();
            header("Location: index.php");
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
		    			<h3>Delete a User</h3>
		    		</div>
		    		
	    			<form class="form-horizontal" action="delete.php" method="post">
	    			  <input type="hidden" name="id" value="<?php echo $id;?>"/>
					  <p class="alert alert-error">Are you sure you want to delete?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Yes</button>
						  <a class="btn" href="index.php">No</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
<?php
    }
}
?>