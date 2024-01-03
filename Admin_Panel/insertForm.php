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
				elseif($_GET["error"]=="nan"){
					echo "You haven't filled a number for a Project Price";
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
				elseif ($_GET['error']=="projFPlanfiletype") {
					echo "You haven't uploaded a proper file type for Project Floor Plan Image(s)";
				}
				elseif ($_GET['error']=="projFPlan") {
					echo "There was an error";
				}
				elseif ($_GET['error']=="projFPlanSize") {
					echo "The size of Project Floor Plan Image(s) is above 500kb and is not excepted";
				}
				elseif ($_GET['error']=="projLocfiletype") {
					echo "You haven't uploaded a proper file type for Project Location";
				}
				elseif ($_GET['error']=="projLoc") {
					echo "There was an error";
				}
				elseif ($_GET['error']=="projLocSize") {
					echo "The size of the Project Location Image is above 500kb and is not excepted";
				}
				elseif ($_GET['error']=="projAlready") {
					echo "The Project is already there.";
				}
			}
			elseif(isset($_GET['uploadsuccess'])){
				echo "<h1 style='color:#009432;font-size:1.1em;'>You have successfully uploaded.</h1>";
			}
		?>
	</div>
	<form method="POST" action="php/insertProj.php" enctype = "multipart/form-data" class="centerAlign">
		<div class="adminInsFormHead">
			<label for="projName">What is the Project Name</label>
			<input type="text" name="projName" placeholder="Type the Project Name">
			<label for="projCapt">What is the Project Caption</label>
			<input type="text" name="projCapt" placeholder="Ex - The home for every sweet dream.">
			<label for="projDesc">Description of Project</label>
			<input type="text" name="projDesc" placeholder="Type in the description of the project">
			<label for="projPrice">What is the price per square feet</label><br>
			<input type="number" name="projPrice" placeholder="ex - 2200"><br>
			<label for="projImg">Upload Image of Project Image</label>
			<input type="file" name="projImg">
			<label for="projPrime">Is it one of you Prime project</label><br>
			<input type="radio" name="projPrime" id="yes" value="yes">
			<label class="radio" for="yes">Yes</label>
			<input type="radio" name="projPrime" id="no" value="no">
			<label class="radio" for="no">No</label><br><br>
			<label for="projConfig">What are the configurations?</label><br>
			<input type="radio" name="projConfig" id="2bhk" value="2BHK">
			<label class="radio" for="2bhk">2BHK</label>
			<input type="radio" name="projConfig" id="3bhk" value="3BHK">
			<label class="radio" for="3bhk">3BHK</label>
			<input type="radio" name="projConfig" id="4bhk" value="2 and 3BHK">
			<label class="radio" for="4bhk">2BHK and 3BHK</label><br><br>
			<label for="projFPlan">Upload Image of Floor Plan (upto 3)</label>
			<input type="file" name="projFPlan[]">
			<input type="file" name="projFPlan[]">
			<input type="file" name="projFPlan[]">
			<label for="projAdv">Type the Advantages of the Project</label>
			<input type="text" name="projAdv[]" placeholder="Advantage 1">
			<input type="text" name="projAdv[]" placeholder="Advantage 2">
			<input type="text" name="projAdv[]" placeholder="Advantage 3">
			<input type="text" name="projAdv[]" placeholder="Advantage 4">
			<label for="projLoc">Type the Google Map Code</label>
			<input type="text" name="projLoc">
			<label for="locAdv">Type in Locality Description</label>
			<input type="text" name="locAdv" placeholder="ex - 30 minutes drive to Gachibowli">
			<button type="submit" name="submit">Upload</button>
		</div>
	</form>
</main>
<?php
	require 'adminFooter.html';
?>