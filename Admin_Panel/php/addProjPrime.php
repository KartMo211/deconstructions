<?php

	if (isset($_POST['add'])) {
		$remProjPrime = $_POST['addProjPrime'];
		$no = 'yes';
		$yes = 'no';

		/*This file is based out of remProjPrime*/
		/*So I swapped the $no and $yes*/
		/*Changed the $_POST[''] part and not the variable to make it easier to finish*/

		if (empty($remProjPrime)) {
			header("Location:../adminHome.php?error=emptyAdd");
			exit();
		}
		else{
			require 'dbh.php';

			$sql = "SELECT * FROM project WHERE projName=?";
			$stmt = mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header('Location:../adminHome.php?error=sqlAdd');
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
						header('Location:../adminHome.php?error=sqlAdd');
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
								header('Location:../adminHome.php?error=sqlAdd');
								exit();
							}
							else{
								mysqli_stmt_bind_param($stmt,"ss",$no,$remProjPrime);
								mysqli_stmt_execute($stmt);

								header("Location:../adminHome.php?successAdd");
								exit();
							}
						}
						else{
							header('Location:../adminHome.php?error=projNotPrimeAdd');
							exit();
						}
					}
				}

				else{
					header('Location:../adminHome.php?error=noProjAdd');
					exit();
				}
				
			}

			mysqli_stmt_close($stmt);
			mysqli_close($conn);
		}
	}

?>