<?php 
	session_start();
	include "config.php";
?>
<html>
	<head>
		<title>Log In Page</title>
	</head>
	<body>
		<style>
	div.scrollable {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    overflow: auto;
	}
	body{
    background-color: #edfaeb; 
	}
	</style>
	<center>
	<table width="350px" height="100%" style="font-family: Sans-Serif; background-color:#aee0a6;">
	<tr>
	
	<td style="vertical-align:top; margin-top:100px;">
	<br>
	<center>
	<p style="font-size:40px">Lyst</p>
	
	<form method="POST">
	Username: 
	<input type="text" name="username" style="width:200px;" required>
			<br><br>
	Password: <input type="password" name="password" style="width:200px;" required>
	<br><br>
	<input type="submit" name="loginBtn" value="Log In">
	<input type="submit" name="registerBtn" value="Create an Account">
	<form>
	<?php
	
		if(isset($_POST['registerBtn'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$checkUsername = "SELECT username FROM Users WHERE username ='".$username."'";
			$result = mysqli_query($con,$checkUsername);
			$numRows = mysqli_num_rows($result);

			//if the length of the query is zero the username is already taken
			if($numRows != 0){
				echo "<br/>Username Taken";
			} else {
				$row = mysqli_fetch_assoc($result);
				$_SESSION['userID'] = $row['userID'];  //Storing the user ID to a session variable
				//Adding the username and password to database
				$insertUsername = "INSERT INTO Users(username,password)
					VALUES('$username','$password')";
				$addUser = mysqli_query($con,$insertUsername);
				header("Location: login.php");
			}
		}

		if(isset($_POST['loginBtn'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$login = "SELECT * FROM Users Where username ='".$username."'";
			$result = mysqli_query($con,$login);
			$numRows = mysqli_num_rows($result);
			
			//if there are no users with that username in the database the user must register
			if($numRows != 1){
				echo "<br/>You must register";
			} else if($numRows = 1){
				$row = mysqli_fetch_assoc($result);
				if($password != $row['password']){
					echo "<br/>Username or Password Incorrect";
				}else{
					$_SESSION['userID'] = $row['userID'];
					header("Location: index.php");
				}
			}
		}
	?>
	</center>
	</td>
	</tr>
	</table>
	</center>
	</body>
</html>