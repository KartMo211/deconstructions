<?php
	if(isset($_POST['submit'])){
		$projName = $_POST['projName'];
		$projCapt = $_POST['projCapt'];
		$projDesc = $_POST['projDesc'];
		$projPrice = $_POST['projPrice'];
		$projAdv = $_POST['projAdv'];
		$locAdv = $_POST['locAdv'];

		if (empty($projName)|| empty($projCapt)||empty($projDesc)||empty($projPrice)|| empty($projAdv)||empty($locAdv)) {
				header("location:../insertForm.php?error=empty");
				exit();
			}
		else{
			if (!ctype_digit($projPrice)) {
				header("location:../insertForm.php?error=nan");
				exit();
			}
			else{
				if (isset($_POST['projPrime']) && isset($_POST['projConfig'])) {
					$projPrime = $_POST['projPrime'];
					$projConfig = $_POST['projConfig'];

					$projImg = $_FILES['projImg'];
					
					$projImgName = $projImg['name'];
					$projImgType = $projImg['type'];
					$projImgTmpName = $projImg['tmp_name'];
					$projImgError = $projImg['error'];
					$projImgSize = $projImg['size'];

					$projImgExt = explode(".",$projImgName);
					$projImgActualExt = strtolower(end($projImgExt));

					$allowed = array('jpg',"jpeg","png");

					if (in_array($projImgActualExt,$allowed)) {
						if ($projImgError === 0) {
							if ($projImgSize < 500000) {
								$projImgNewName = $projName.".projImg.".$projImgActualExt;
								$projImgDestination = "../../Images/".$projImgNewName;

								//projFPlan images
								$projFPlan = $_FILES['projFPlan'];

								$projFPlanName = $projFPlan['name'];
								$projFPlanType = $projFPlan['type'];
								$projFPlanTmpName = $projFPlan['tmp_name'];
								$projFPlanError = $projFPlan['error'];
								$projFPlanSize = $projFPlan['size'];

								$projFPlanExt1 = explode(".",$projFPlanName[0]);
								$projFPlanExt2 = explode(".",$projFPlanName[1]);
								$projFPlanExt3 = explode(".",$projFPlanName[2]);


								$projFPlanActualExt = array(strtolower(end($projFPlanExt1)),strtolower(end($projFPlanExt2)),strtolower(end($projFPlanExt3)));

								if (in_array($projFPlanActualExt[0],$allowed) && in_array($projFPlanActualExt[0],$allowed)&& in_array($projFPlanActualExt[2],$allowed)) {
									if ($projFPlanError[0] === 0 && $projFPlanError[1] === 0 && $projFPlanError[2] === 0){
										if ($projFPlanSize[0] < 500000||$projFPlanSize[1] < 500000||$projFPlanSize[2] < 500000) {
											$projFPlanNewName = array($projName.".projFPlan1.".$projFPlanActualExt[0],$projName.".projFPlan2.".$projFPlanActualExt[1],$projName.".projFPlan3.".$projFPlanActualExt[2]);

											$projFPlanDestination =array("../../Images/".$projFPlanNewName[0],"../../Images/".$projFPlanNewName[1],"../../Images/".$projFPlanNewName[2]);


											//the script code for google maps

											$projLoc = $_POST['projLoc'];

											require 'dbh.php';

											$sql = "SELECT * FROM project where projName = ?";
					 						$stmt = mysqli_stmt_init($conn);
					 						if(!mysqli_stmt_prepare($stmt,$sql)){
					 							echo "Sql statement failed";
					 						}
					 						else{
					 							mysqli_stmt_bind_param($stmt,"s",$projName);
												mysqli_stmt_execute($stmt);
												mysqli_stmt_store_result($stmt);
												$result=mysqli_stmt_num_rows($stmt);

												if($result>0){
													header('Location:../insertForm.php?error=projAlready');
													exit();
												}
												else{
													$sql = "INSERT INTO project(projName,projCapt,projDesc,projPrice,projImg,projPrime,projConfig) VALUES (?, ?, ?,?,?,?,?);";
						 							if(!mysqli_stmt_prepare($stmt,$sql)){
							 							echo "Sql statement failed1";
							 							exit();
							 						}
							 						else{
							 							mysqli_stmt_bind_param($stmt,"sssisss",$projName,$projCapt,$projDesc,$projPrice,$projImgNewName,$projPrime,$projConfig);
							 							mysqli_stmt_execute($stmt);

							 							$sql = "INSERT INTO FPlan(projName,FPlan1,FPlan2,FPlan3) VALUES (?, ?, ?,?);";
							 							if(!mysqli_stmt_prepare($stmt,$sql)){
								 							echo "Sql statement failed2";
								 							exit();
								 						}
								 						else{
								 							mysqli_stmt_bind_param($stmt,"ssss",$projName,$projFPlanNewName[0],$projFPlanNewName[1],$projFPlanNewName[2]);
								 							mysqli_stmt_execute($stmt);
								 							
								 							$sql = "INSERT INTO projHighlight(projName,adv1,adv2,adv3,adv4) VALUES (?, ?, ?,?,?);";
								 							if(!mysqli_stmt_prepare($stmt,$sql)){
									 							echo "Sql statement failed3";
									 						}
									 						else{
									 							mysqli_stmt_bind_param($stmt,"sssss",$projName,$projAdv[0],$projAdv[1],$projAdv[2],$projAdv[3]);
									 							mysqli_stmt_execute($stmt);

									 							$sql = "INSERT INTO projLocality(projName,localAdv,googMapLoc) VALUES (?, ?, ?);";
									 							if(!mysqli_stmt_prepare($stmt,$sql)){
										 							echo "Sql statement failed4";
										 						}
										 						else{
										 							mysqli_stmt_bind_param($stmt,"sss",$projName,$locAdv,$projLoc);
										 							mysqli_stmt_execute($stmt);

										 							move_uploaded_file($projImgTmpName, $projImgDestination);

										 							for ($i=0; $i <= 3 ; $i++) { 
										 								move_uploaded_file($projFPlanTmpName[$i], $projFPlanDestination[$i]);
										 							}

										 							header("Location: ../insertForm.php?uploadsuccess");
										 							exit();
										 							
										 						}
									 						}
								 						}
							 						}
												}
					 						}

					 						mysqli_stmt_close($stmt);
											mysqli_close($conn);

										}																
										else{
											header("Location:../insertForm.php?error=projFPlanSize");
											exit();
										}
									}
									else{
										header("Location:../insertForm.php?error=projFPlan");
										exit();
									}
								}
								else{
									header("Location:../insertForm.php?error=projFPlanfiletype");
									exit();
								}

							}
							else{
								header("Location:../insertForm.php?error=projImgSize");
								exit();
							}
						}
						else{
							header("Location:../insertForm.php?error=projImg");
							exit();
						}
					}
					else{
						header("Location:../insertForm.php?error=projImgfiletype");
						exit();
					}
					
				}
				else{
					header("location:../insertForm.php?error=empty");
					exit();
				}
			}
		}
	}
?>