<?php
	require 'MainNavbar/navbar.html';
?>
<main style="margin-top:110px;">
<?php
	
	if (isset($_POST['submit'])) {
		require 'Admin_Panel/php/dbh.php';

		$projName = $_POST['submit'];

		$sql = "SELECT * FROM project WHERE projName = ?";
		$sql1 = "SELECT * FROM FPlan WHERE projName = ?";
		$sql2 = "SELECT * FROM projHighlight WHERE projName = ?";
		$sql3 = "SELECT * FROM projLocality WHERE projName = ?";


		$stmt=mysqli_stmt_init($conn);
		$stmt1=mysqli_stmt_init($conn);
		$stmt2=mysqli_stmt_init($conn);
		$stmt3=mysqli_stmt_init($conn);

		if (!mysqli_stmt_prepare($stmt,$sql) || !mysqli_stmt_prepare($stmt1,$sql1) || !mysqli_stmt_prepare($stmt2,$sql2) || !mysqli_stmt_prepare($stmt3,$sql3)) {
			echo "Sql statement failed";
		}
		else{
			mysqli_stmt_bind_param($stmt,"s",$projName);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			mysqli_stmt_bind_param($stmt1,"s",$projName);
			mysqli_stmt_execute($stmt1);
			$result1 = mysqli_stmt_get_result($stmt1);

			mysqli_stmt_bind_param($stmt2,"s",$projName);
			mysqli_stmt_execute($stmt2);
			$result2 = mysqli_stmt_get_result($stmt2);

			mysqli_stmt_bind_param($stmt3,"s",$projName);
			mysqli_stmt_execute($stmt3);
			$result3 = mysqli_stmt_get_result($stmt3);
			
			$row = mysqli_fetch_assoc($result);
			$row1 =  mysqli_fetch_assoc($result1);
			$row2 =  mysqli_fetch_assoc($result2);
			$row3 =  mysqli_fetch_assoc($result3); 

			echo '

				<div class="nest" align="center">
	                <h1>Every great building<br> once began<br> as a building plan</h1>
	                <div class="nestcontent">
	                <section>
	                    <div class="Row">
	                        <div class="buildcolumn">
	                        <figure>
	                            <img src="Images/'.$row['projImg'].'">
	                        </figure>
	                        </div>
	                        <div class="buildcolumn">
	                            <div class="nestlogo">
	                                <span>'.$row['projName'].'</span>
	                                <h1>'.$row['projCapt'].'</h1>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row" id="row2">
	                        <div class="infocolumn">
	                            <h1>Price per square feet</h1>
	                            <span>'.$row['projPrice'].'<sup>*</sup> INR</span>
	                        </div>
	                        <div class="infocolumn">
	                            <h1>Possession Time</h1>
	                            <span>March 2023</span>
	                        </div>
	                        <div class="infocolumn">
	                            <h1>Configurations</h1>
	                            <span>'.$row['projConfig'].'</span>
	                        </div>
	                    </div>
	                    </section>
	                </div>
	            </div>

	            <div class="fPlanBlackBackground" id="fPlanBackground">
	            	<a class="closefPlanBtn" onclick="closeImg(1)" id="closefPlanBtn1">&times;</a>
	            	<a class="closefPlanBtn"  onclick="closeImg(2)" id="closefPlanBtn2">&times;</a>
	            	<a class="closefPlanBtn"  onclick="closeImg(3)" id="closefPlanBtn3">&times;</a>
	            </div>



	            <div class="nestdesign">
	            	<section>
	                <h1 class="heading">View our Masterplans</h1>
	                <p>In what we do, we are perfect. We have designed the layout in a way were you could experience the quiescent atmosphere along with the serenity that diffuses tension. Let the excitement ooze out of you.</p>
	                </section>
	                <div align="center" style="min-height:400px;">
	                <figure><img class="FPlan" src="Images/'.$row1['FPlan1'].'" onclick="enlarge(1)" id="fPlan1" alt="'.$row1['FPlan1'].'"></figure>
	                <figure><img class="FPlan" src="Images/'.$row1['FPlan2'].'" alt="'.$row1['FPlan2'].'" onclick="enlarge(2)" id="fPlan2"></figure>
	                <figure><img class="FPlan" src="Images/'.$row1['FPlan3'].'" alt="'.$row1['FPlan3'].'" onclick="enlarge(3)" id="fPlan3"></figure>
	                </div>
	            </div>

	            <div class="nestdesign">
	                <h1 class="heading">Specifications</h1>
	                <div class="container">
	                    <a onclick="plusSlide(-1)">&#10094;</a>
	                    <a onclick="plusSlide(1)">&#10095;</a>
	                    <div class="rows fade" align="center">
	                        <div class="speccolumn">
	                            <div class="content">
	                            <section>
	                                <h1>Structure</h1>
	                                <span>RCC framed structure</span>
	                            </section>
	                            </div>
	                            <div class="content">
	                            <section>
	                              <h1>Walls</h1>
	                              <span>Red burnt bricks with cement mortar</span>
	                            </section>
	                            </div>
	                        </section>
	                        </div>
	                        <div class="speccolumn">
	                            <figure><img src="Images/projCreate/bricks.jpeg" alt="bricks"></figure>
	                        </div>
	                    </div>
	                    <div class="rows fade" align="center">
	                        <div class="speccolumn">
	                            <div class="content">
	                            <section>
	                                <h1>Doors</h1>
	                                <span>Main Door: Best quality teak wood frame and Veneer flush door with polish.<br>Other Doors: Door frames with teak wood and water proof flush shutters.</span>
	                            </section>
	                            </div>
	                            <div class="content">
	                            <section>
	                              <h1>Walls</h1>
	                              <span>Red burnt bricks with cement mortar</span>
	                            </section>
	                            </div>
	                        </div>
	                        <div class="speccolumn">
	                            <figure><img src="Images/projCreate/teak.jpg" alt="Teak Wood"></figure>
	                        </div>
	                    </div>
	                    <div class="rows fade" align="center">
	                        <div class="speccolumn">
	                            <div class="content">
	                            <section>
	                                <h1>Toilets</h1>
	                                <span>Ceramic wall tiles with cladding up to door height & Anti skid ceramic tiles for flooring</span>
	                            </section>
	                            </div>
	                        </div>
	                        <div class="speccolumn">
	                            <figure><img src="Images/projCreate/toilet.jpg" alt="toilet Quality"></figure>
	                        </div>
	                    </div>
	                    <div class="rows fade" align="center">
	                        <div class="speccolumn">
	                            <div class="content">
	                            <section>
	                                <h1>Plastering</h1>
	                                <span>Two coats of smooth internal plastering and two coats external plastering with water proof cement compound</span>
	                            </section>
	                            </div>
	                            <div class="content">
	                            <section>
	                                <h1>Kitchen</h1>
	                                <span>Black granite counter top with stainless stell sink<br>2" height wall tile dado above counter top with provision for bore water & municipal water connection</span>
	                            </section>
	                            </div>
	                        </div>
	                        <div class="speccolumn">
	                            <figure><img src="Images/projCreate/kitchen.jpeg" alt="kitchen"></figure>
	                        </div>
	                    </div>
	                    <div class="rows fade" align="center">
	                        <div class="speccolumn">
	                            <div class="content">
	                            <section>
	                                <h1>Electrical</h1>
	                                <span>Concealed Sudhkar PVC pipes & copper wiring with necessary points.<br>Switches - Legrand.<br>Wiring - Finolex / Equivalent</span>
	                            </section>
	                            </div>
	                            <div class="content">
	                          	<section>
	                                <h1>Painting</h1>
	                                <span><span style="font-weight:bold;">Internal:</span> Asian Tractor Emulsion paint with roller finishding over putty finish.</span><br>
	                                <span><span style="font-weight:bold;">External:</span> Weather proof cement based paint for all external walls</span>
	                            </section>
	                            </div>
	                        </div>
	                        <div class="speccolumn">
	                            <figure><img src="Images/projCreate/paints.jpg" alt="Asian Paints"></figure>
	                        </div>
	                    </div>
	                    <div class="rows fade" align="center">
	                        <div class="speccolumn">
	                        	
	                            <div class="content">
	                            <section>
	                                <h1>Flooring</h1>
	                                <span>2 X 2 Vitrified tiles flooring for hall, bedrooms, dinig, kitchen and balcony. Anti-skid tiles in toilets & wash area.</span>
	                            </section>
	                            </div>
	                            <div class="content">
	                            <section>
	                                <h1>Plumbing</h1>
	                                <span>CPVC fitting - Ashirvad / Sudhakar</span><br>
	                                <span>PVC fittings - Ashirvad / Sudhakar</span><br>
	                                <span>Bathroom sanitary - CERA / Equivalent</span>
	                            </section>
	                            </div>
	                        </div>
	                        <div class="speccolumn">
	                            <figure><img src="Images/projCreate/tiles.jpg" alt="tiles"></figure>
	                        </div>
	                    </div>
	                    <div class="rows fade" align="center">
	                        <div class="speccolumn">
	                        	
	                            <div class="content">
	                            <section>
	                                <h1>Water supply</h1>
	                                <span>Underground and overhead storage tanks of suitable capapcity with bore-well as an auxiliary source of water supply</span>
	                            </section>
	                            </div>
	                            <div class="content">
	                            <section>
	                                <h1>Plumbing</h1>
	                                <span>Generator for lift, motors, common lighting in the corridor and parking</span><br>
	                                <span>Generator - Mahindra / Mahindra and Equivalent</span><br>
	                            </section>
	                            </div>
	                            <div class="content">
	                            <section>
	                                <h1>Lift</h1>
	                                <span>Lift of standard-make</span><br>
	                            </section>
	                            </div>
	                        </div>
	                        <div class="speccolumn">
	                            <figure><img src="Images/projCreate/lighting.jpg" alt="Perfect Lighting"></figure>
	                        </div>
	                    </div>
	                </div>
	            </div>


	            <div class="advantages">
	            <section>
	                    <h1 class="texthigh">Project</h1>
	                    <h1 class="texthigh">Highlights</h1>
	                    <div class="reasons">
	                        <div class="paragraph">
	                            '.$row2['adv1'].'
	                        </div>
	                        <div class="paragraph">
	                            '.$row2['adv2'].'
	                        </div>
	                    </div>
	                    <div class="reasons">
	                        <div class="paragraph">
	                            '.$row2['adv3'].'
	                        </div>
	                        <div class="paragraph">
	                            '.$row2['adv4'].'
	                        </div>
	                    </div>
	            </section>
	            </div>
	            <div class="advantages" align="center">
	            <section>
	                <h1 class="neighbour" align="left">Locality</h1>
	                <div class="iconrow">
	                    <div class="iconcolumn" align="center">
	                        <i class="fa fa-car"></i>
	                        <span>'.$row3['localAdv'].'</span>
	                    </div>
	                    <div class="iconcolumn" align="center">
	                        <i class="material-icons">security</i>
	                        <span>Something which is looked forward the most is something which we never forget to accomplish. We have strong bases of security that is boosted by CCTV cameras as well as the nearby gated communities.</span>
	                    </div>
	                </div>
	            </section>
	            </div>
	            <div style="padding:2%;text-align:center;">
	            	'.$row3['googMapLoc'].'
	            </div>

			';
		}

		mysqli_stmt_close($stmt);
		mysqli_close($conn);

	}

?>
<?php
	require 'bookSection/book.html';
?>
</main>
<script>
	var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlide(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("rows");
      if (n > slides.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";  
      }
      slides[slideIndex-1].style.display = "block";  
    }
</script>
<script type="text/javascript">
	function enlarge(n){
		var id= "fPlan"+n;
		var displayCloseBtn = "closefPlanBtn"+n;


		var closeBtn = document.getElementById(displayCloseBtn);
		var fPlan = document.getElementById(id);
		var fPlanBg = document.getElementById('fPlanBackground');

		
		fPlanBg.style.width="100%";
		fPlan.className="FPlanChange";
		closeBtn.style.display="block";

	}
	function closeImg(n){
		var id= "fPlan"+n;
		var imgId = "closefPlanBtn"+n;

		 var displayCloseBtn = document.getElementById(imgId);
		var fPlan = document.getElementById(id);
		var fPlanBg = document.getElementById('fPlanBackground');

		displayCloseBtn.style.display="none";
		fPlanBg.style.width="0%";
		fPlan.className="FPlan";
	}
</script> 
<?php
	require 'footer/footer.html';
?>


