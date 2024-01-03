<?php
require 'adminNavbar.html';
require 'adminMenu.html';
?>
<main>
	<div class="adminInstruct">
		<h1>Instructions to Follow</h1>
		<ul>
			<li>Delete ONLY when required.</li>
			<li>Once deleted, you can NOT recieve the information back.</li>
		</ul>
	</div>
	<?php
		if (isset($_GET['error'])) {
			if ($_GET['error']=="sql") {
				echo "<h1 class='bookForm'>Internal Error</h1>";
			}
		}
		elseif(isset($_GET['success'])){
			echo "<h1 class='bookForm' style='color:#009432;'>It is has been deleted.</h1>";
		}
	?>
	<table class="adminInfo">
		<caption>Booking Details</caption>
		<thead>
			<tr class="adminThead">
				<th>Email Id</th>
				<th>Phone Number</th>
				<th>Book Date</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			<?php
				require 'php/dbh.php';

				$sql = "SELECT * FROM booking ORDER BY dates ASC;";
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
								<td>".$row['email_id']."</td>
								<td>".$row['phone_number']."</td>
								<td>".$row['dates']."</td>
								<td>
									<form method='POST' action='php/delBooking.php'>
										<button type='submit' class='delBook' name='delBook' value=".$row['email_id'].">Delete</button>
									</form>
								</td>
							</tr>
						";
					}
				}
				mysqli_stmt_close($stmt);
				mysqli_close($conn);
			?>
		</tbody>
	</table>
</main>
<?php
	require 'adminFooter.html';
?>