<?php

require 'index.php'; 
$email= "mistryvisma17ite@student.mes.ac.in";
$content='<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet"><div style="background-color:#E8EAF6 ; padding-top:20px ; padding-bottom:20px ; padding-left:15px ; padding-right:15px"><h2 style="font-family:Ubuntu, sans-serif;color: black;">Dear Smart Door Administrator,</h2><p style="font-family:Ubuntu, sans-serif;text-align:left; font-size:15px;color: black;">An Unauthorized Person was detected who was trying to enter through the Smart Door. The Person was blocked from entering.</p><p style="font-family:Ubuntu, sans-serif; text-align:center; font-size:25px;color: black;"><strong>Please Open Application</strong></p><p style="font-family:Ubuntu, sans-serif;text-align:left; font-size:15px;color: black;">Visit the Admin panel to checkout the details of the intrusions.<br>Thank You for using the Smart Door.<br><br><strong>Regards,<br>Stay Secure.</strong></p></div>';
email("user",$content,$email,"Unauthorized Person Blocked from Entering");

?>