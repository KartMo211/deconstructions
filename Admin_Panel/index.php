<?php
require 'adminNavbar.html';
?>

<form class="adminLogin" action="php/validate.php" method="post">
	<label for="password">Enter the password</label>
	<input type="password" name="password">
	<button type="submit" name="submit">Enter</button>
	<div class="adminErrors">
		<?php
			if(isset($_GET["error"])){
					if($_GET["error"]=="empty"){
						echo "Please fill all the fields !";
					}
					elseif($_GET["error"]=="wrongpass"){
						echo "Wrong Password Entered !";
				}
			}
		?>
	</div>
</form>
<?php
	require 'adminFooter.html';
?>