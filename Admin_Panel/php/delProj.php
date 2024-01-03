<?php
	if (isset($_POST['delete'])) {
		$delProj = $_POST['delProjName'];

		if(empty($delProj)){
			header("Location:../adminHome.php?error=emptyDel");
			exit();
		}
		else{
			require 'dbh.php';

			$sql = "SELECT * FROM project WHERE projName = ?";
			$stmt = mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($stmt,$sql)) {
				header("Location:../adminHome.php?error=sqlDel");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt,"s",$delProj);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);

				if ($row = mysqli_fetch_assoc($result)) {
					$projImgPath = "../../Images/".$row['projImg'];
					if (!unlink($projImgPath)) {
						header("Location:../adminHome.php?error=sqlDel");
						exit();
					}
					else{
						$sql = "SELECT * FROM FPlan WHERE projName = ?";

						if (!mysqli_stmt_prepare($stmt,$sql)) {
							header("Location:../adminHome.php?error=sqlDel");
							exit();
						}
						else{
							mysqli_stmt_bind_param($stmt,"s",$delProj);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);

							if ($row = mysqli_fetch_assoc($result)) {
								$FPlanPath =array("../../Images/".$row['FPlan1'],"../../Images/".$row['FPlan2'],"../../Images/".$row['FPlan3']);
								for ($i=0; $i <3 ; $i++) { 
									if (!unlink($FPlanPath[$i])) {
										header("Location:../adminHome.php?error=sqlDel");
										exit();
									}
								}
								
									$sql = "DELETE FROM project WHERE projName = ?";

									if (!mysqli_stmt_prepare($stmt,$sql)) {
										header("Location:../adminHome.php?error=sqlDel");
										exit();
									}
									else{
										mysqli_stmt_bind_param($stmt,"s",$delProj);
										mysqli_stmt_execute($stmt);

										$sql = "DELETE FROM FPlan WHERE projName = ?";
										if (!mysqli_stmt_prepare($stmt,$sql)) {
											header("Location:../adminHome.php?error=sqlDel");
											exit();
										}
										else{
											mysqli_stmt_bind_param($stmt,"s",$delProj);
											mysqli_stmt_execute($stmt);
											$sql = "DELETE FROM projHighlight WHERE projName = ?";
											if (!mysqli_stmt_prepare($stmt,$sql)) {
												header("Location:../adminHome.php?error=sqlDel");
												exit();
											}
											else{
												mysqli_stmt_bind_param($stmt,"s",$delProj);
												mysqli_stmt_execute($stmt);

												$sql = "DELETE FROM projLocality WHERE projName = ?";
												if (!mysqli_stmt_prepare($stmt,$sql)) {
													header("Location:../adminHome.php?error=sqlDel");
													exit();
												}
												else{
													mysqli_stmt_bind_param($stmt,"s",$delProj);
													mysqli_stmt_execute($stmt);

													header("location:../adminHome.php?successDel");
													exit();
												}
											}
										}
									}
							}
							else{
								header("location:../adminHome.php?error=noProjDel");
								exit();
							}
						}
					}
				}
				else{
					header("location:../adminHome.php?error=noProjDel");
					exit();
				}
			}
			mysqli_stmt_close($stmt);
			mysqli_close($conn);
		}
	}
?>