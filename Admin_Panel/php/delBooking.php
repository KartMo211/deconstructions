<?php
	
	if (isset($_POST['delBook'])) {

		$emailId = $_POST['delBook'];

		require 'dbh.php';

		$sql = "DELETE FROM booking WHERE email_id=?";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt,$sql)) {
			header('Location:../bookForm.php?error=sql');
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"s",$emailId);
			mysqli_stmt_execute($stmt);

			header("Location:../bookForm.php?success");
			exit();
		}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	}

?>