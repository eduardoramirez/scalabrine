<?php
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
    header("Location: /dashboard/login");
}
else{
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
    		<div class="row">
    			<h3>admin - CRUD</h3>
                <h4>OrgID: <?php echo $_SESSION['orgID']?></h4>
                <h4>role: <?php echo $_SESSION['admin']?></h4>
    		</div>
			<div class="row">
				<p>
					<a href="create.php" class="btn btn-success">Create</a>
				</p>
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Username</th>
		                  <th>Email Address</th>
		                  <th>Password</th>
		                  <th>Action</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
					   include 'database.php';
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM user WHERE OrgID = ' . $_SESSION['orgID'] . ' ORDER BY ID DESC';
	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['Username'] . '</td>';
							   	echo '<td>'. $row['Email'] . '</td>';
							   	echo '<td>'. $row['Password'] . '</td>';
							   	echo '<td style="white-space:nowrap;">';
							   	echo '<a class="btn" href="read.php?id='.$row['ID'].'">Read</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-success" href="update.php?id='.$row['ID'].'">Update</a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="delete.php?id='.$row['ID'].'">Delete</a>';
							   	echo '</td>';
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>
<?php
}
?>