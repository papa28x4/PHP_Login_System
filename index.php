<?php 
	session_start();
	if($_SESSION['username']){
		$user = $_SESSION['username'];
	}else{
		header('Location: login.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
</head>
<style type="text/css">
	.navbar{
		background-color: magenta;
		color: white;
		height: 10%;
		text-align: center;
	}
</style>
<body>
	<div class="navbar">
		<h1>Welcome <?php echo $user ?></h1>
		<form method="POST" action="scripts/logout.php">
			<button name="logout">Logout</button>
		</form>
		
	</div>
</body>
</html>