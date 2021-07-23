<?php 

session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: faceauth.php");
    exit;
}

$username = $password = "";
$username_err = $password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(empty(trim($_POST["uname"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["uname"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty($username_err) && empty($password_err)){
    if ($username=="admin@face" && $password=="password") {
      session_start(); 
      $_SESSION["loggedin"] = true;
      header("location: faceauth.php");
    }
    else{
      $password_err = "Incorrect Credentials";
    }
  }
  else{

  }
}
?>
<!DOCTYPE HTML>
<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Envault 2019">
  <link rel="shortcut icon" href="../images/sqff1bde_128x127.png" type="image/x-icon">
  <title>Login to Smart Door Admin Panel</title>

	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style type="text/css">
*{
	box-sizing: border-box;
}
body{
		font-family: 'Josefin Sans', sans-serif;
		background-color: #1c1c1c;
		padding: 0;
		margin: 0;
	}

.containbox{
	margin-top: 7%;
	margin-left: 32%;
	padding: 0px 0px 0px 0px;
	height: 250px;
	width: 460px;
	background-color: #393e46;
	text-align: center;
	border-bottom-left-radius: 7px;
	border-bottom-right-radius: 7px;
  border-top-left-radius: 7px;
  border-top-right-radius: 7px;
}
.logbox{
	width: 100%;
	height: 250px;
	margin-bottom: 0;
	padding: 18px 10px 10px 2px;
	text-align: center;
	background-color: #393e46;
	border-bottom-left-radius: 7px;
	border-bottom-right-radius: 7px;
  border-top-left-radius: 7px;
  border-top-right-radius: 7px;
}
.logbox input[type="text"], input[type="password"]{
	width: 60%;
	height: 50px;
	padding: 5px;
	margin-top: 5px;
	margin-bottom: 5px;
	background-color: #393e46;
	border: none;
	border-bottom: 2px solid  #dbedf3;
	font-size: 16px;
	color: #eeeeee;
}
.logbox input[type="text"]:focus, input[type="password"]:focus{
	background-color: #393e46;
	color: #eeeeee;
}
.submitbtn{
	width: 105px;
	height: 55px;
	margin-top: 25px;
	margin-left: -12px;
	padding: 8px 5px 8px 5px;
	font-size: 1.25em;
	background-color: #04879c;
	color: #eeeeee;
	border-radius: 20px;
	border: none;
}
.label{
	height: 10px;
	background-color: #393e46;
	width: 60%;
	margin: 2px 0 0 85px;
	font-size: 14px;
	color: #ca3e47;
	padding: 1px;
}	

@media screen and (max-width: 1024px){
  .containbox{
  margin-top: 10%;
  margin-left: 26%;
  padding: 0px 0px 0px 0px;
  height: 250px;
  width: 390px;
  background-color: #393e46;
  text-align: center;
  border-bottom-left-radius: 7px;
  border-bottom-right-radius: 7px;
  border-top-left-radius: 7px;
  border-top-right-radius: 7px;
}
.logbox{
  width: 100%;
  height: 250px;
  margin-bottom: 0;
  padding: 18px 10px 10px 2px;
  text-align: center;
  background-color: #393e46;
  border-bottom-left-radius: 7px;
  border-bottom-right-radius: 7px;
  border-top-left-radius: 7px;
  border-top-right-radius: 7px;
}
.submitbtn{
  width: 82px;
  height: 35px;
  margin-top: 25px;
  margin-left: -12px;
  padding: 5px 5px 8px 5px;
  font-size: 1.25em;
  background-color: #04879c;
  color: #eeeeee;
  border-radius: 20px;
  border: none;
}
.label{
  height: 8px;
  background-color: #393e46;
  width: 60%;
  margin: 2px 0 0 85px;
  font-size: 10px;
  color: #ca3e47;
  padding: 1px;
}

}

@media screen and (max-width: 900px){
  .containbox{
  margin-top: 15%;
  margin-left: 28%;
  padding: 0px 0px 0px 0px;
  height: 250px;
  width: 360px;
  background-color: #393e46;
  text-align: center;
  border-bottom-left-radius: 7px;
  border-bottom-right-radius: 7px;
  border-top-left-radius: 7px;
  border-top-right-radius: 7px;
}
.logbox{
  width: 100%;
  height: 250px;
  margin-bottom: 0;
  padding: 18px 10px 10px 2px;
  text-align: center;
  background-color: #393e46;
  border-bottom-left-radius: 7px;
  border-bottom-right-radius: 7px;
  border-top-left-radius: 7px;
  border-top-right-radius: 7px;
}
.submitbtn{
  width: 82px;
  height: 35px;
  margin-top: 25px;
  margin-left: -12px;
  padding: 5px 5px 8px 5px;
  font-size: 1.25em;
  background-color: #04879c;
  color: #eeeeee;
  border-radius: 20px;
  border: none;
}
.label{
  height: 8px;
  background-color: #393e46;
  width: 60%;
  margin: 2px 0 0 85px;
  font-size: 10px;
  color: #ca3e47;
  padding: 1px;
}

}
@media screen and (max-width: 768px){
  .containbox{
  margin-top: 15%;
  margin-left: 28%;
  padding: 0px 0px 0px 0px;
  height: 250px;
  width: 360px;
  background-color: #393e46;
  text-align: center;
  border-bottom-left-radius: 7px;
  border-bottom-right-radius: 7px;
  border-top-left-radius: 7px;
  border-top-right-radius: 7px;
}
.logbox{
  width: 100%;
  height: 250px;
  margin-bottom: 0;
  padding: 18px 10px 10px 2px;
  text-align: center;
  background-color: #393e46;
  border-bottom-left-radius: 7px;
  border-bottom-right-radius: 7px;
  border-top-left-radius: 7px;
  border-top-right-radius: 7px;
}
.submitbtn{
  width: 82px;
  height: 35px;
  margin-top: 25px;
  margin-left: -12px;
  padding: 5px 5px 8px 5px;
  font-size: 1.25em;
  background-color: #04879c;
  color: #eeeeee;
  border-radius: 20px;
  border: none;
}
}
@media screen and (max-width: 575px){
  .containbox{
  margin-top: 19%;
  margin-left: 15%;
  padding: 0px 0px 0px 0px;
  height: 250px;
  width: 360px;
  background-color: #393e46;
  text-align: center;
  border-bottom-left-radius: 7px;
  border-bottom-right-radius: 7px;
  border-top-left-radius: 7px;
  border-top-right-radius: 7px;
}
.logbox{
  width: 100%;
  height: 250px;
  margin-bottom: 0;
  padding: 18px 10px 10px 2px;
  text-align: center;
  background-color: #393e46;
  border-bottom-left-radius: 7px;
  border-bottom-right-radius: 7px;
  border-top-left-radius: 7px;
  border-top-right-radius: 7px;
}
.submitbtn{
  width: 82px;
  height: 35px;
  margin-top: 25px;
  margin-left: -12px;
  padding: 5px 5px 8px 5px;
  font-size: 1.25em;
  background-color: #04879c;
  color: #eeeeee;
  border-radius: 20px;
  border: none;
}

}
@media screen and (max-width: 480px){
  .containbox{
  margin-top: 28%;
  margin-left: 5%;
  margin-right: 5%;
  padding: 0px 0px 0px 0px;
  height: 250px;
  width: 360px;
  background-color: #393e46;
  text-align: center;
  border-bottom-left-radius: 7px;
  border-bottom-right-radius: 7px;
  border-top-left-radius: 7px;
  border-top-right-radius: 7px;
}
.logbox{
  width: 100%;
  height: 250px;
  margin-bottom: 0;
  padding: 18px 10px 10px 2px;
  text-align: center;
  background-color: #393e46;
  border-bottom-left-radius: 7px;
  border-bottom-right-radius: 7px;
  border-top-left-radius: 7px;
  border-top-right-radius: 7px;
}
.submitbtn{
  width: 82px;
  height: 35px;
  margin-top: 25px;
  margin-left: -12px;
  padding: 5px 5px 8px 5px;
  font-size: 1.25em;
  background-color: #04879c;
  color: #eeeeee;
  border-radius: 20px;
  border: none;
}
} 
</head>
</style>
<body>
<div class="containbox">
    <div style="height: 20px;color: white;padding: 10px;font-size: 20px;margin-bottom: 25px;"><big><big><b>Log In To Admin Panel</b></big></big></div>
    <div class="logbox">
    <form method= "post">
    <input type="text" name="uname" placeholder="Enter Username">
    <p id="emailerr" class="label"><?php echo $username_err; ?></p>
    <input type="password" name="password" placeholder="Enter Password">
    <p id="emailerr" class="label"><?php echo $password_err; ?></p>
    <input type="submit" name="loginbtn" class="submitbtn" value="Go!">
    </form>
     </div>
  </div>
  </body>
</html>