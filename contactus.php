<?php
    require 'MainNavbar/navbar.html';
?>
<main style="margin-top:110px;">
    <div class="meet">
        <div class="contacttext">
            <section>
                <h1>Get In Touch</h1><br>
                <span>Want to get in touch? We'd love to hear from you. Here's how you can contact us.</span>
            </section>
        </div>
    </div>
    <div class="contactrow" align="center">
        <div class="contactcolumn">
            <section>
                <i class="material-icons">call</i>
                <span class="main">Talk to sales</span>
                <span class="info">
                    Interested in our projects? Just pick up the phone to chat with a member of our sales team
                </span>
                <span class="phone">+91 9652153366</span>
                <span class="phone">+91 7702791000</span>
                <span class="phone">+91 8074320947</span>
                <span class="phone">+91 9742350734</span>
            </section>            
        </div>
        <div class="contactcolumn">
            <section>
                <i class="fa fa-handshake-o"></i>
                <span class="main">Book an appointment</span>
                <span class="info">
                    Sometimes you need a little help to create a sturdy decision. Don't worry... we're here for you.
                </span>
                <button class="book2" onclick="window.location.href = '#form';">Schedule</button>
                <span class="info" style="text-align:center; padding-bottom:0;">
                    OR
                </span>
                <span class="info" style="padding-top:0;">Email us at:</span>
                <span class="phone">
                    <a href="mailto:srconstructions712@gmail.com?subject=enquiry">srconstructions712@gmail.com</a>
                </span>
            </section>
        </div>
    </div>
    <div class="bookform" id="form">
        <div class="formtext">
            <h1>Book an Appointment</h1>
            <form method="POST" action="mainPHP/input.php">
                <label for="email">Enter your E-mail:</label>
                <input type="text" placeholder="e.g srconstructions712@gmail.com" name="email" class="email">
                <label for="date">Enter the desired Date:</label>
				<input type="text" pattern="[01-31/01-12/01-99]{8}" name="date" id="txtDate" placeholder="<?php echo 'e.g '.date('d/m/y');?>" maxlength="8">
                <label for="phoneno">Enter your phone number:</label>
                <input type="text" placeholder="10-digit number" maxlength="10" pattern="[0-9]{10}" name="phoneno">
				<input type="submit" value="Book" name="submit">
            </form>
			<div class="instructions">
                <section>
                    <span>Office timing: 10 AM to 6PM</span>
                    <span>If you make a mistake, you could just re-type in the details again and click book.You can book only one month in advance.</span>
                </section>
			</div>
        </div>
    </div>
</main>
<script>
     <?php 
        if(isset($_GET["error"])){
            if($_GET["error"]=="emptyfields"){
                echo "alert('Please fill all the fields');";
            }
            elseif($_GET["error"]=="invaliddate"){
                echo "alert('Invalid date entered');";
            }
            elseif($_GET["error"]=="alreadybooked"){
                echo "alert('You have already booked');";
            }
            elseif($_GET["error"]=="overtime"){
                echo "alert('You can book only 1 month in advance');";
            }
            elseif($_GET["error"]=="mysqli"){
                echo "alert('Reload the page');";
            }
            elseif($_GET["error"]=="invalidemail"){
                echo "alert('Enter a proper email');";
            }
            elseif($_GET["error"]=="invalidphone"){
                echo "alert('You haven't entered a correct phone number');";
            }
        }
        elseif(isset($_GET["success"])){
            if($_GET["success"]=="updatedate"){
                echo "alert('You will recieve an email and your booking date has been updated');";
            }
            elseif($_GET["success"]=="updatedatephone"){
                echo "alert('You will recieve an email and your booking date and phone number are updated');";
            }
            elseif($_GET["success"]=="updateemail"){
                echo "alert('You will recieve an email and your email address has been updated');";
            }
            elseif($_GET['success']=="insert"){
                echo "alert('You will recieve an email of the booking');";
            }
        }
     ?>
</script>
<script>
    $(document).ready(function(){ 
        $("#txtDate").keyup(function(e){
            if (e.keyCode != 8){   
                if ($(this).val().length == 2){
                    $(this).val($(this).val() + "/");
                }
                else if ($(this).val().length == 5){
                    $(this).val($(this).val() + "/");
                }
            }
        });   
    });
</script> 
<?php
    require 'footer/footer.html';
?>