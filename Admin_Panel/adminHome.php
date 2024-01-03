<?php
require 'adminNavbar.html';
require 'adminMenu.html';
?>
<main>
	<div class="adminInstruct">
		<h1>Instructions to Follow</h1>
		<ul>
			<li>Here are the list of current projects.</li>
			<li>If you want to upload a new project, please click Insert link on menu.</li>
			<li>When you click on 'x' in the row, it deletes the entire project.</li>
			<li>Please don't share your password.</li>
			<li>Images will ONLY be displayed on the Website</li>
			<li>Basic Content will be displayed here</li>
		</ul>
	</div>
	<table class="adminInfo">
		<caption>List of Projects</caption>
		<thead>
			<tr class="adminThead">
				<th>Project Name</th>
				<th>Project Price</th>
				<th>Project Configurations</th>
				<th>Prime Project</th>
			</tr>
		</thead>
		<tbody>
			<?php
				require 'php/dbh.php';

				$sql = "SELECT * FROM project ORDER BY id DESC;";
				$stmt = mysqli_stmt_init($conn);

				if (!mysqli_stmt_prepare($stmt,$sql)) {
					echo "Sql statement failed";
				}
				else{
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);

					while($row = mysqli_fetch_assoc($result)){
						echo "
							<tr>
								<td>".$row['projName']."</td>
								<td>INR ".$row['projPrice']."</td>
								<td>".$row['projConfig']."</td>
								<td>".$row['projPrime']."</td>
							</tr>
						";
					}
				}
				mysqli_stmt_close($stmt);
				mysqli_close($conn);
			?>
		</tbody>
	</table>
	<div class="adminDelete">
		<span class="delTitle">Delete Project</span>

		<?php
		/*This variable differentiates between errors of Remove and Add*/
			$add = "Del";

			if (isset($_GET['error'])) {
				if ($_GET['error']=="empty".$add) {
					echo "<span class='delError'>Please fill in the field !</span>";
				}
				elseif($_GET["error"]=="sql".$add){
					echo "<span class='delError' class='delError' class='delError'>there is an internal problem.</span>";
				}
				elseif ($_GET['error']=="noProj".$add) {
					echo "<span class='delError' class='delError'>There is no such Project</span>";
				}
			}
			elseif(isset($_GET['success'.$add])){
				echo "<span class='delError' style='color:#009432;'>It is has been deleted.</span>";
			}
		?>

		<form action = "php/delProj.php" method="post">
			<input type="text" name="delProjName" placeholder="Type in the Project Name which you want to delete">
			<button type="submit" name="delete">Delete</button>
		</form>
	</div>
	<div class="adminDelete">
		<span class="delTitle">Remove Prime Project</span>
		
		<?php
		/*This variable differentiates between errors of Remove and Add*/
			$add = "Rem";

			if (isset($_GET['error'])) {
				if ($_GET['error']=="empty".$add) {
					echo "<span class='delError'>Please fill in the field !</span>";
				}
				elseif($_GET["error"]=="sql".$add){
					echo "<span class='delError' class='delError' class='delError'>there is an internal problem.</span>";
				}
				elseif ($_GET['error']=="projNotPrime".$add) {
					echo "<span class='delError' class='delError'>The Project is already not a prime project</span>";
				}
				elseif ($_GET['error']=="noProj".$add) {
					echo "<span class='delError'>There is no project with such name.</span>";
				}
			}
			elseif(isset($_GET['success'.$add])){
				echo "<span class='delError' style='color:#009432;'>It is no longer a prime Project</span>";
			}
		?>
		
		<form action = "php/remProjPrime.php" method="post">
			<input type="text" name="remProjPrime" placeholder="Type in the Project Name which will no longer be a prime">
			<button type="submit" name="remove">Remove</button>
		</form>
	</div>
	<div class="adminDelete">
		<span class="delTitle">Make Prime Project</span>

		<?php
			$add = "Add";
			if (isset($_GET['error'])) {
				if ($_GET['error']=="empty".$add) {
					echo "<span class='delError'>Please fill in the field !</span>";
				}
				elseif($_GET["error"]=="sql".$add){
					echo "<span class='delError' class='delError' class='delError'>there is an internal problem.</span>";
				}
				elseif ($_GET['error']=="projNotPrime".$add) {
					echo "<span class='delError' class='delError'>The Project is already a prime project</span>";
				}
				elseif ($_GET['error']=="noProj".$add) {
					echo "<span class='delError'>There is no project with such name.</span>";
				}
			}
			elseif(isset($_GET['success'.$add])){
				echo "<span class='delError' style='color:#009432;'>It is a prime Project</span>";
			}
		?>

		<form action = "php/addProjPrime.php" method="post">
			<input type="text" name="addProjPrime" placeholder="Type in the Project Name which is needs to be a prime">
			<button type="submit" name="add">Add</button>
		</form>
	</div>
</main>
<?php
	require 'adminFooter.html';
?>