<?php
	if (isset($_POST['submit'])) {
		$password = $_POST['password'];
		if (empty($password)) {
			header("Location:../login.php?error=empty");
			exit();
		}
		else{
			if ($password === "Joshvin1607") {
				header("Location:../adminHome.php");
				exit();
			}
			else{
				header("Location:../login.php?error=wrongpass");
				exit();
			}
		}
	}
?>