<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Admin Dashboard</title>
	</head>
	<body>
		
		<h1>Welcome <?php echo $_SESSION['username'] ?>!</h1>
	</body>
</html>