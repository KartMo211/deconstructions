<?php
    $to=$email;
	$subject="Thanks for booking an appointment";
	$message = "We can't wait to meet you. If you didn't make this request, you could ignore it. You can visit the office between 10AM and 6PM during the working days. The location of the office is : Plot Nos: 5-8, Opp Praneeth Homes, K.V.R Valley, Mallampet Village,Hyderabad"."\r\n".
		"Here are your booking details:"."\r\n"."Email-Id: ".$email."\r\n"."Phone number: " .$phoneno."\r\n"."Date: ".$date."\r\n";
				
	$header = "From:SR Constructions <no-reply@srconstructions.in.net>"."\r\n"."Reply to: srconstructions712@gmail.com"."\r\n";
									
    mail($to,$subject,$message,$header);