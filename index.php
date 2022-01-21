<!DOCTYPE html>
<html>
<head>
<style>
.button-css {
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  cursor: pointer;
  padding: 10px 20px;
  border: 1px solid #018dc4;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  font: normal 26px/normal Tahoma, Geneva, sans-serif;
  color: rgba(255,255,255,0.9);
  -o-text-overflow: clip;
  text-overflow: clip;
  letter-spacing: 6px;
  word-spacing: 4px;
  background: -webkit-linear-gradient(-90deg, rgba(59,103,158,1) 0, rgba(43,136,217,1) 50%, rgba(32,124,202,1) 51%, rgba(125,185,232,1) 100%);
  background: -moz-linear-gradient(180deg, rgba(59,103,158,1) 0, rgba(43,136,217,1) 50%, rgba(32,124,202,1) 51%, rgba(125,185,232,1) 100%);
  background: linear-gradient(180deg, rgba(59,103,158,1) 0, rgba(43,136,217,1) 50%, rgba(32,124,202,1) 51%, rgba(125,185,232,1) 100%);
  background-position: 50% 50%;
  background-size: auto auto;
  text-shadow: -1px -1px 0 rgba(15,73,168,0.66) ;
}
.text2-css {
  display: inline-block;
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  padding: 10px 20px;
  border: 1px solid #b7b7b7;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  font: normal 16px/normal "Comic Sans MS", cursive, sans-serif;
  color: rgba(0,142,198,1);
  -o-text-overflow: clip;
  text-overflow: clip;
  -webkit-box-shadow: 2px 2px 2px 0 rgba(0,0,0,0.2) inset;
  box-shadow: 2px 2px 2px 0 rgba(0,0,0,0.2) inset;
}
.text1-css {
  display: inline-block;
  -webkit-box-sizing: content-box;
  -moz-box-sizing: content-box;
  box-sizing: content-box;
  padding: 10px 20px;
  border: 1px solid #b7b7b7;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  font: normal 16px/normal "Comic Sans MS", cursive, sans-serif;
  color: rgba(0,142,198,1);
  -o-text-overflow: clip;
  text-overflow: clip;
}
.take_input {
   display: flex;
   justify-content: center;
}

</style>
</head>
<body>
	<div class="take_input">
		<form method="POST" action="#">
			<h1>WELCOME TO INTERNSHIP APPLICATION PROGRAM</h1>
			<br>
			<label>User Name </label>
			<input class="text2-css" name="userName" placeholder="User Name" />
			<h1></h1>
			<label>Password  </label>
			<input class="text1-css" name="password" type=password placeholder="Password" />	
			<h1></h1>
			<input type="submit" name="test" class="button-css" value="Login" />
		</form>
	</div>

</body>
</html>


<?php


session_start();
require_once "config.php";

//control whether logın button is clicked or not
if( array_key_exists('test', $_POST) ){ 
	$userName = $_POST['userName'];
	$userPass = $_POST['password'];

	//control whether user name filed is empty or not
	if( empty($userName))
	{
		echo '<script>alert("You must fill user name area")</script>';
		echo "<script LANGUAGE='JavaScript'>
              					window.location.href = 'index.php';
        					</script>";
	}

	//control whether user pass filed is empty or not
	if( empty($userPass))
	{
		echo '<script>alert("You must fill user password area")</script>';
		echo "<script LANGUAGE='JavaScript'>
              					window.location.href = 'index.php';
        					</script>";
	}

	$sqlQuery = "SELECT sid, sname FROM student WHERE sname='$userName' AND sid='$userPass'";
	$result =mysqli_query($adress, $sqlQuery);

	//control whether password and user name match with the one in database
	if( mysqli_num_rows($result)==1){
		echo "Loged In";
		session_start();
		$_SESSION['userName'] = $userName;
		$_SESSION['userPassword'] = $userPass;
		header('Location: welcome.php' );
	}
	else{
		echo '<script>alert("User name or password is not correct. Please try again")</script>';
		echo "<script LANGUAGE='JavaScript'>
              					window.location.href = 'index.php';
        					</script>";
	}
}

?>








