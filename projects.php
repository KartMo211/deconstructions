<?php
	require 'MainNavbar/navbar.html';
?>
<main style="margin-top:110px;">
	<div class="projBackground">
		<section>
			<h1>Our Projects</h1>
		</section>
		<div class="projShade"></div>
	</div>
	<?php
		require 'Admin_Panel/php/dbh.php';

		$sql = "SELECT * FROM project ORDER BY id DESC;";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "Sql statement failed";
		}
		else{
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			while($row = mysqli_fetch_assoc($result)){
				echo '

					<div class="projRow">
					<figure>
						<img src="Images/'.$row['projImg'].'" alt="Project Image">
					</figure>
					<div class="projName">
						<section>
							<span>'.$row['projName'].'</span>
						</section>	
					</div>
					<div class="projDetailRow">
						<div class="projDetailCol">
							<section>
								<span class="projHeading">Price per Sq Ft</span><br>
								<span class="projDetail">INR '.$row['projPrice'].'</span>
							</section>
						</div>
						<div class="projDetailCol">
							<section>
								<span class="projHeading">Configurations</span><br>
								<span class="projDetail">'.$row['projConfig'].'</span>
							</section>
						</div>
					</div>
					<div class="projText">
						<section>
							<span>'.$row['projDesc'].'</span>
						</section>
					</div>
					<form action="projCreate.php" method="post">
						<button type="submit" name="submit" value="'.$row['projName'].'"><span class="know">Know more </span></button>
					</form>
				</div>

				';
			}
		}
	?>

		<!--THIS IS FOR PREVIOUS PROJECTS-->

	<div class="projBackground" style="background-image:url('Images/projects/prevProjBackground.jpg')">
		<section>
			<h1>Other Projects</h1>
		</section>
		<div class="projShade"></div>
	</div>
	<div class="prevProjRow">
	<?php

		$sql = "SELECT * FROM prevProj ORDER BY id DESC;";
		$stmt = mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt,$sql)) {
			echo "Sql statement failed";
		}
		else{
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			while($row = mysqli_fetch_assoc($result)){
				echo '

					<div class="prevProjColumn">
						<figure>
							<img src="Images/prevProj/'.$row['prevProjImg'].'" alt="Project Image">
						</figure>
						<div class="projName">
							<section>
								<span>'.$row['prevProjName'].'</span>
							</section>	
						</div>
						<div class="projText">
							<section>
								<span><a href="contactus.php">Contact Us</a></span>
							</section>
						</div>
					</div>

				';
			}
		}


		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	?>
	</div>
	<?php
		require 'bookSection/book.html';
	?>
</main>
<?php
	require 'footer/footer.html';
?>