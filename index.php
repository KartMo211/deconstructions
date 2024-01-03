<?php
	require 'MainNavbar/navbar.html';
?>
<main style="margin-top:110px">
	<div class="projSlideShow">

		<?php
			require 'Admin_Panel/php/dbh.php';

			$sql = "SELECT * FROM project ORDER BY id DESC LIMIT 5;";
			$stmt = mysqli_stmt_init($conn);

			if (!mysqli_stmt_prepare($stmt,$sql)) {
				echo "Sql statement failed";
			}
			else{
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				while ($row = mysqli_fetch_assoc($result)) {
					echo '

					<div class="projSlide fade">
						<figure>
							<img src="Images/'.$row['projImg'].'">
						</figure>
						<div class="projSlideText">
							<section>
								<span class="projTitle">
									'.$row['projName'].'
								</span>
								<span class="projCapt">
									'.$row['projCapt'].'
								</span>
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
	<div class="content">
        <div class="quote">
            <h1>Why chose SR Constructions?</h1>
        </div>
        <div class="info">
        	<section>
            	<span>Headquartered in Hyderabad, we strive to be more than a construction company; we aim to be thought leaders in our industry by providing our clients with continuous insight, sharing the latest trends and communicating updates safety standards and regulations.</span>
            </section>
        </div>
        <div class="imagerow">
            <div class="imagecolumn">
            	<section>
            		<figure>
            			<img src="Images/home/happy.jpeg">
            		</figure>
	                <div class="card">
	                    Delivering our promises
	                </div>
            	</section>
            </div>
            <div class="imagecolumn">
            	<section>
            		<figure>
                		<img src="Images/home/worker2.jpeg">
                	</figure>
	                <div class="card">
	                    Fullfulling our promises
	                </div>
	            </section>
            </div>
            <div class="imagecolumn">
            	<section>
            		<figure>
                		<img src="Images/home/plan.jpeg">
                	</figure>
	                <div class="card">
	                    Planning our promises
	                </div>
	            </section>
            </div>
        </div>
    </div>
    <div class="projPrimeBackground">
	    <div class="projPrimes"><!--This displays only 5 prime projects-->
	    	<section>
	    		<span class="primeTitle">Our Prime Projects</span>
	    		<div class="primeRow">
	    			<?php
						require 'Admin_Panel/php/dbh.php';

						$yes = 'yes';
						$sql = "SELECT * FROM project WHERE projPrime = ? ORDER BY id DESC LIMIT 4;";
						$stmt = mysqli_stmt_init($conn);

						if (!mysqli_stmt_prepare($stmt,$sql)) {
							echo "Sql statement failed";
						}
						else{
							mysqli_stmt_bind_param($stmt,"s",$yes);
							mysqli_stmt_execute($stmt);
							$result = mysqli_stmt_get_result($stmt);

							while($row = mysqli_fetch_assoc($result)){
								echo '
									<div class="primeColumn">
						    			<figure>
						    				<img src="Images/'.$row['projImg'].'">
						    			</figure>
						    			<span class="projTitle">'.$row['projName'].'</span>
						    			<div class="primeDesc">
						    				'.$row['projDesc'].'
						    			</div>
						    			<form action="projCreate.php" method="post">
											<button type="submit" name="submit" value="'.$row['projName'].'"><span class="know">Know more </span></button>
										</form>
						    		</div>
								';
							}
						}
						mysqli_stmt_close($stmt);
						mysqli_close($conn);
					?>
	    		</div>
	    	</section>
	    </div>
	</div>
    <?php
		require 'bookSection/book.html';
	?>
</main>
<script>
	var slideIndex = 0;
	showSlides();

	function showSlides() {
	  var i;
	  var slides = document.getElementsByClassName("projSlide");
	  for (i = 0; i < slides.length; i++) {
	    slides[i].style.display = "none";  
	  }
	  slideIndex++;
	  if (slideIndex > slides.length) {slideIndex = 1}    
	  slides[slideIndex-1].style.display = "block";
	  setTimeout(showSlides, 4000); // Change image every 2 seconds
	}
</script>
<?php
	require 'footer/footer.html';
?>