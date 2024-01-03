<?php
if(isset($_POST['submit'])){
	require '../Admin_Panel/php/dbh.php';
	$email= $_POST['email'];
	$date = $_POST['date'];
	list($d, $m, $y) = explode("/", $date);
	$date2="$y/$m/$d";
	$phoneno = $_POST['phoneno'];
	date_default_timezone_set('Asia/Kolkata');

	if(empty($email)||empty($date)||empty($phoneno)){
		header("location: ../contactus.php?error=emptyfields&email=".$email."&date=".$date."&phoneno=".$phoneno);
		exit();
	}
	elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)|| $email=="srconstructions712@gmail.com"){
		header("Location:../contactus.php?error=invalidemail&date=" .$date."&phoneno=".$phoneno);
		exit();
	}
	elseif(checkdate($m,$d,$y) == false OR $date2 < date('y/m/d')){
		header("Location:../contactus.php?error=invaliddate&email=".$email."&phoneno=".$phoneno);
		exit();
	}
	elseif($date2>date("y/m/d",strtotime("+1 month"))){
		header("location:../contactus.php?error=overtime&email=".$email."&phoneno=".$phoneno);
		exit();
	}
	elseif(in_array($phoneno,array("9652153366","7702791000","8074320947","9742350734"))){
		header("location:../contactus.php?error=invalidphone&email=".$email."&phoneno=".$phoneno);
		exit();
	}
	else{
		$sql="Select * from booking where email_id=? and phone_number=? and dates=?";
		$stmt=mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("location:../contactus.php?error=mysqli&email=".$email."&date=".$date."&phoneno=".$phoneno);
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"sss",$email,$phoneno,$date2);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$result=mysqli_stmt_num_rows($stmt);

			if($result>0){
				header("location:../contactus.php?error=alreadybooked&email=".$email."&date=".$date."&phoneno=".$phoneno);
				exit();
			}
			else{
				$sql="Select * from booking where email_id=?";
				$stmt=mysqli_stmt_init($conn);

				if(!mysqli_stmt_prepare($stmt,$sql)){
					header("Location:../contactus.php?error=mysqli&email=".$email."&date=".$date."&phoneno=".$phoneno);
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt,"s",$email);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
					$result=mysqli_stmt_num_rows($stmt);

					if($result>0){
						$sql="Select * from booking where email_id=? and phone_number=?";
						$stmt=mysqli_stmt_init($conn);

						if(!mysqli_stmt_prepare($stmt,$sql)){
							header("Location:../contactus.php?error=mysqli&email=".$email."&date=".$date."&phoneno=".$phoneno);
							exit();
						}
						else{
							mysqli_stmt_bind_param($stmt,"ss",$email,$phoneno);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_store_result($stmt);
							$result=mysqli_stmt_num_rows($stmt);
							
							if($result>0){
								$sql="update booking set dates=? where email_id=? and phone_number=?";
								$stmt=mysqli_stmt_init($conn);
								if(!mysqli_stmt_prepare($stmt,$sql)){
									header("Location:../contactus.php?error=mysqli&email=".$email."&date=".$date."&phoneno=".$phoneno);
									exit();
								}
								else{
									mysqli_stmt_bind_param($stmt,"sss",$date2,$email,$phoneno);
									mysqli_stmt_execute($stmt);
									header("location:../contactus.php?success=updatedate&email=".$email."&date=".$date."&phoneno=".$phoneno);
									exit();
								}
							}
							else{
								$sql="update booking set phone_number=?,dates=? where email_id=?";
								$stmt=mysqli_stmt_init($conn);
								
								if(!mysqli_stmt_prepare($stmt,$sql)){
									header("Location:../contactus.php?error=mysqli&email=".$email."&date=".$date."&phoneno=".$phoneno);

									exit();
								}
								else{
									mysqli_stmt_bind_param($stmt,"sss",$phoneno,$date2,$email);
									mysqli_stmt_execute($stmt);

									require 'mail.php';

									header("location:../contactus.php?success=updatedatephone&email=".$email."&date=".$date."&phoneno=".$phoneno);
									exit();
								}
							}
						}
					}
					else{
						$sql="Select * from booking where phone_number=? and dates=?";
						$stmt=mysqli_stmt_init($conn);

						if(!mysqli_stmt_prepare($stmt,$sql)){
							header("Location:../contactus.php?error=mysqli&email=".$email."&date=".$date."&phoneno=".$phoneno);
							exit();
						}
						else{
							mysqli_stmt_bind_param($stmt,"ss",$phoneno,$date2);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_store_result($stmt);
							$result=mysqli_stmt_num_rows($stmt);

							if($result>0){
								$sql="update booking set email_id=? where phone_number=? and dates=?";
								$stmt=mysqli_stmt_init($conn);

								if(!mysqli_stmt_prepare($stmt,$sql)){
									header("Location:../contactus.php?error=mysqli&email=".$email."&date=".$date."&phoneno=".$phoneno);
									exit();
								}
								else{
									mysqli_stmt_bind_param($stmt,"sss",$email,$phoneno,$date2);
									mysqli_stmt_execute($stmt);
									header("location:../contactus.php?success=updateemail&email=".$email."&date=".$date."&phoneno=".$phoneno);
									exit();
								}
							}
							else{
								$sql="Insert into booking (email_id,phone_number,dates) values(?,?,?)";
								$stmt=mysqli_stmt_init($conn);

								if(!mysqli_stmt_prepare($stmt,$sql)){
									header("Location:../contactus.php?error=mysqli&email=".$email."&date=".$date."&phoneno=".$phoneno);
									exit();
								}
								else{
									mysqli_stmt_bind_param($stmt,"sss",$email,$phoneno,$date2);
									mysqli_stmt_execute($stmt);
									header("location:../contactus.php?success=insert&email=".$email."&date=".$date."&phoneno=".$phoneno);
									exit();
								}
							}
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
	header("location:../contactus.php");
	exit();
}