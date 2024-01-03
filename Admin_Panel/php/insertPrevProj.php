<?php
	if(isset($_POST['submit'])){
		$projName = $_POST['projName'];

		if (empty($projName)) {
			header("location:../insertPrevForm.php?error=empty");
			exit();
		}
		else{
			//this is for projects with less info

			$projImg = $_FILES['projImg'];

			$projImgName = $projImg['name'];
			$projImgType = $projImg['type'];
			$projImgTmpName = $projImg['tmp_name'];
			$projImgError = $projImg['error'];
			$projImgSize = $projImg['size'];

			$projImgExt = explode(".",$projImgName);
			$projImgActualExt = strtolower(end($projImgExt));

			$allowed = array("jpeg","jpg","png");

			if(in_array($projImgActualExt, $allowed)){
				if($projImgError ==0){
					if ($projImgSize<500000) {
						$projImgNewName = $projName.".projImg.".$projImgActualExt;
						$projImgDestination = "../../Images/prevProj/".$projImgNewName;

						require 'dbh.php';

						$sql = "SELECT * FROM prevProj where prevProjName = ?";
						$stmt = mysqli_stmt_init($conn);

						if(!mysqli_stmt_prepare($stmt,$sql)){
							header("Location:../insertPrevForm.php?error=mysql");
							exit();
						}

						else{
							mysqli_stmt_bind_param($stmt,"s",$projName);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_store_result($stmt);
							$result = mysqli_stmt_num_rows($stmt);

							if($result>0){
								header("location:../insertPrevForm.php?error=preAlreadyExist");
								exit();
							}
							else{

								$sql = "SELECT * FROM project WHERE projName = ?";
								$stmt = mysqli_stmt_init($conn);
								if(!mysqli_stmt_prepare($stmt,$sql)){
									header("Location:../insertPrevForm.php?error=mysql");
									exit();
								}
								else{
									mysqli_stmt_bind_param($stmt,"s",$projName);
									mysqli_stmt_execute($stmt);
									mysqli_stmt_store_result($stmt);
									$result = mysqli_stmt_num_rows($stmt);

									if($result>0){
										header("location:../insertPrevForm.php?error=AlreadyExist");
										exit();
									}
									else{
										$sql="INSERT INTO prevProj(prevProjName,prevProjImg) VALUES (?,?)";
										$stmt = mysqli_stmt_init($conn);

										if(!mysqli_stmt_prepare($stmt,$sql)){
											header("Location:../insertPrevForm.php?error=mysql");
											exit();
										}
										else{
											mysqli_stmt_bind_param($stmt,"ss",$projName,$projImgNewName);
											mysqli_stmt_execute($stmt);

											move_uploaded_file($projImgTmpName, $projImgDestination);

											header("Location: ../insertPrevForm.php?uploadsuccess");
										 	exit();
										}
									}
								}
							}
						}
						mysqli_stmt_close($stmt);
						mysqli_close($conn);
					}
					else{
						header("Location:../insertPrevForm.php?error=projImgSize");
						exit();
					}
				}
				else{
					header("Location:../insertPrevForm.php?error=projImg");
					exit();
				}
			}
			else{
				header("Location:../insertPrevForm.php?error=projImgfiletype");
				exit();
			}

		}

	}

?>