<?php

	if (isset($_POST['remove'])) {
		$remProjPrime = $_POST['remProjPrime'];
		$yes = 'yes';
		$no = 'no';

		if (empty($remProjPrime)) {
			header("Location:../adminHome.php?error=emptyRem");
			exit();
		}
		else{
			require 'dbh.php';

			$sql = "SELECT * FROM project WHERE projName=?";
			$stmt = mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header('Location:../adminHome.php?error=sqlRem');
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"s",$remProjPrime);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$result = mysqli_stmt_num_rows($stmt);

				if ($result > 0) {
					$sql = "SELECT * FROM project WHERE projName = ? AND projPrime = ?";

					if(!mysqli_stmt_prepare($stmt,$sql)){
						header('Location:../adminHome.php?error=sqlRem');
						exit();
					}
					else{
						mysqli_stmt_bind_param($stmt,"ss",$remProjPrime,$yes);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_store_result($stmt);
						$result=mysqli_stmt_num_rows($stmt);
						if ($result>0) {
							$sql = "UPDATE project SET projPrime = ? WHERE projName = ?";

							if(!mysqli_stmt_prepare($stmt,$sql)){
								header('Location:../adminHome.php?error=sqlRem');
								exit();
							}
							else{
								mysqli_stmt_bind_param($stmt,"ss",$no,$remProjPrime);
								mysqli_stmt_execute($stmt);

								header("Location:../adminHome.php?successRem");
								exit();
							}
						}
						else{
							header('Location:../adminHome.php?error=projNotPrimeRem');
							exit();
						}
					}
				}

				else{
					header('Location:../adminHome.php?error=noProjRem');
					exit();
				}
				
			}

			mysqli_stmt_close($stmt);
			mysqli_close($conn);
		}
	}

?>