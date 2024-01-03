<?php
require 'adminNavbar.html';
require 'adminMenu.html';
?>
<main>
	<div class="adminInstruct">
		<h1>Instructions to Follow</h1>
		<ul>
			<li>You MUST fill all the details.</li>
			<li>Please cross check the data before you upload.</li>
			<li>All Currency format is ruppee. So please type the numbers only.</li>
			<li>The file size of Images should be less than 500kb.</li>
			<li>the file extension of Images should be '.png','.jpeg' or '.jpg'.</li>
		</ul>
	</div>
	<div class="adminErrors">
		<?php
			if (isset($_GET['error'])) {
				if($_GET["error"]=="empty"){
					echo "Please fill all the fields !";
				}
				elseif ($_GET['error']=="projImgfiletype") {
					echo "You haven't uploaded a proper file type for Project Image";
				}
				elseif ($_GET['error']=="projImg") {
					echo "There was an error";
				}
				elseif ($_GET['error']=="projImgSize") {
					echo "The size of the Project Image is above 500kb and is not excepted";
				}
				elseif ($_GET['error']=="preAlreadyExist") {
					echo "The Project Name is already there in prevProj Table.";
				}
				elseif ($_GET['error']=="AlreadyExist") {
					echo "The Project Name is already there in Project Table.";
				}
			}
			elseif(isset($_GET['uploadsuccess'])){
				echo "<h1 style='color:#009432;font-size:1.1em;'>You have successfully uploaded.</h1>";
			}
		?>
	</div>
	<form method="POST" action="php/insertPrevProj.php" enctype = "multipart/form-data" class="centerAlign">
		<div class="adminInsFormHead">
			<label for="projName">What is the Project Name</label>
			<input type="text" name="projName" placeholder="Type the Project Name">
			<label for="projImg">Upload Image of Project Image</label>
			<input type="file" name="projImg">
			<button type="submit" name="submit">Upload</button>
		</div>
	</form>
</main>
<?php
	require 'adminFooter.html';
?>