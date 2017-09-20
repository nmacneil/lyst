<?php 
	session_start();
	include "config.php";
	date_default_timezone_set("Canada/Newfoundland");
	if($_SESSION["userID"] == 0)
		header("Location: login.php")
?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
	<meta name="description" content="To Do List Application For CS 3715">
	<meta name="keywords" content="HTML, CSS, JavaScript, PHP, AJAX">
	<meta name="authors" content="Eric Roy Elli, Christian Goodridge, Nathan MacNeil">
	<title>To Do List</title>

	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script type="text/javascript">
	
		function setMinDate() {
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0
			var yyyy = today.getFullYear();
			if(dd<10){
			    dd='0'+dd
			} 
			if(mm<10){
				mm='0'+mm
			} 

			today = yyyy+'-'+mm+'-'+dd;
			document.getElementById("dueDate").setAttribute("min", today);
			document.getElementById("dateBox").setAttribute("min", today);
		}
		
		function dbGen()//Ajax is used to load database items on page load
		{
			console.log("This ran");
			if (window.XMLHttpRequest) {
			    // code for IE7+, Firefox, Chrome, Opera, Safari
			    xmlhttp=new XMLHttpRequest();
			  } else { // code for IE6, IE5
			    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  xmlhttp.onreadystatechange=function() {
			    if (this.readyState==4 && this.status==200) {
			      document.getElementById("workspace").innerHTML=this.responseText;
			    }
			  }
			  xmlhttp.open("GET","populate.php?q=l",true);
			  xmlhttp.send();
		}
		
		 function dbMod(val, id)//A multipurpose function to handle any modifications to the database
		{
			console.log("This ran");
			console.log(val);
			console.log(id);
			if (window.XMLHttpRequest) {
			    // code for IE7+, Firefox, Chrome, Opera, Safari
			    xmlhttp=new XMLHttpRequest();
			  } else { // code for IE6, IE5
			    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  xmlhttp.onreadystatechange=function() {
			    if (this.readyState==4 && this.status==200) {
			      document.getElementById("workspace").innerHTML=this.responseText;
			    }
			  }
			  xmlhttp.open("GET","populate.php?q="+ val + "&title=" + document.getElementById("titleBox").value + "&disc="+ document.getElementById("discBox").value + "&date=" + document.getElementById("dateBox").value
			+ "&id=" + id+ "&comp=" + document.getElementById("compBox").value,true);
			  xmlhttp.send();
		} 	
		
		function invokeEdit1(id)//Used to autofill the edit bar
		{
			console.log(id);
			if (window.XMLHttpRequest) {
			    // code for IE7+, Firefox, Chrome, Opera, Safari
			    xmlhttp=new XMLHttpRequest();
			  } else { // code for IE6, IE5
			    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  xmlhttp.onreadystatechange=function() {
			    if (this.readyState==4 && this.status==200) {
			      document.getElementById("titleBox").value=this.responseText;
			    }
			  }
			  xmlhttp.open("GET","invoker.php?id="+id+"&step=a",true);
			  xmlhttp.send();
			invokeEdit2(id);
		}
			
			function invokeEdit2(id)//Due to an unknown error invokeEdit needed to be spearated per field
		{
			console.log(id);
			if (window.XMLHttpRequest) {
			    // code for IE7+, Firefox, Chrome, Opera, Safari
			    xmlhttp=new XMLHttpRequest();
			  } else { // code for IE6, IE5
			    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  xmlhttp.onreadystatechange=function() {
			    if (this.readyState==4 && this.status==200) {
			      document.getElementById("discBox").value=this.responseText;
			    }
			  }
			  xmlhttp.open("GET","invoker.php?id="+id+"&step=b",true);
			  xmlhttp.send();
			invokeEdit3(id);
		}
		
		function invokeEdit3(id)
		{
			console.log(id);
			if (window.XMLHttpRequest) {
			    // code for IE7+, Firefox, Chrome, Opera, Safari
			    xmlhttp=new XMLHttpRequest();
			  } else { // code for IE6, IE5
			    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  xmlhttp.onreadystatechange=function() {
			    if (this.readyState==4 && this.status==200) {
			      document.getElementById("dateBox").value=this.responseText;
			    }
			  }
			  xmlhttp.open("GET","invoker.php?id="+id+"&step=c",true);
			  xmlhttp.send();
			invokeEdit4(id);
		}
		
		function invokeEdit4(id)
		{
			console.log(id);
			if (window.XMLHttpRequest) {
			    // code for IE7+, Firefox, Chrome, Opera, Safari
			    xmlhttp=new XMLHttpRequest();
			  } else { // code for IE6, IE5
			    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  xmlhttp.onreadystatechange=function() {
			    if (this.readyState==4 && this.status==200) {
			      document.getElementById("idBox").value=this.responseText;
			    }
			  }
			  xmlhttp.open("GET","invoker.php?id="+id+"&step=d",true);
			  xmlhttp.send();
			invokeEdit5(id);
		}
		
		function invokeEdit5(id)
		{
			console.log(id);
			if (window.XMLHttpRequest) {
			    // code for IE7+, Firefox, Chrome, Opera, Safari
			    xmlhttp=new XMLHttpRequest();
			  } else { // code for IE6, IE5
			    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			  xmlhttp.onreadystatechange=function() {
			    if (this.readyState==4 && this.status==200) {
			      document.getElementById("compBox").value=this.responseText;
			    }
			  }
			  xmlhttp.open("GET","invoker.php?id="+id+"&step=e",true);
			  xmlhttp.send();
			//invokeEdit6(id);
		}
		
		function toggleForm() {
			editForm = document.getElementById("hideable");
			if(editForm.style.display == ""){
				editForm.style.display = "none";
			} else {
				editForm.style.display = "";
			}
		}
	</script>
	
</head>
<body onload="setMinDate(); dbGen()">
<style>
		div.scrollable {
		    width: 100%;
		    height: 100%;
		    margin: 0;
		    padding: 0;
		    overflow: auto;
		}
		body{
		    background-color: #f0edff; 
		}	
	</style>
	<table width="100%" height="100%" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; font-family: Sans-Serif;">
	<tr>
		<td style="padding:10px; width:200px; background-color:#ffe0e0; vertical-align:top">
		<form method="POST">	
			<center><p style="font-size:35px; font-family:Tahoma;">Lyst</p></center><br>
			Title:<br>
			<input type="text" name="Title" style="width:200px;" required>
			<br><br>
			Description:<br>
			<textarea name="Description" style="height:100px;width:200px;"></textarea>
			<br><br>
			Date:<br>
			<input type="date" id="dueDate" name="dueDate" required>
			<br><br>
			<center><input type="submit" name="submitBtn" value = "Add"></center>
		</form>
		<?php
			if (isset($_POST['submitBtn'])) {//adds items to the db through the submit bar
				$title = $_POST['Title'];
				$description = $_POST['Description'];
				$date = date('Y-m-d',strtotime($_POST['dueDate']));
				$userID = $_SESSION['userID'];


				$insert = "INSERT INTO ListItems (task,description,due_date,owner) 
					VALUES('$title','$description','$date','$userID')";
				mysqli_query($con,$insert);
				//header("Location: #");
			}
		?>
		<center><table>
		<br></br> <a href="logout.php">Log Out</a><br></br>
			<tr>
				<td style="background-color: #ffb7b7;width:20%;border:2px solid #696969;">
				</td>
				<td>&nbsp;- Overdue
				</td>
			</tr>
			<tr>
				<td style="background-color: #ffffe0;border:2px solid #696969;">
				</td>
				<td>&nbsp;- Upcoming
				</td>
			</tr>
			<tr>
				<td style="background-color: #b8e9af;border:2px solid #696969;">
				</td>
				<td>&nbsp;- Complete
				</td>
			</tr>
			<tr>
				<td style="background-color: #ffcc99;border:2px solid #696969;">
				</td>
				<td>&nbsp;- Due today
				</td>
			</tr>
			</table></center>
		<td style="padding:20px;vertical-align:top">
		<div class=scrollable>
		<p id="container" onload="dbGen()">
		<center id="workspace">
		
		
		
		</center>
		</p>
		
		</div>
		</td>
		
		<td>
			<td id="hideable" style="display:none; padding:10px; width:200px; background-color:#ccfcff; vertical-align:top"><form>
			<br><br><br><br>
			<center><p style="font-size:20px; font-family:Tahoma;">Edit Goal:</p><br></center>
			Title:<br>
			<input type="text" name="title" style="width:200px;" id="titleBox" required>
			<br><br>
			Description:<br>
			<textarea name="description" style="height:100px;width:200px;" id="discBox"><</textarea>
			<br><br>
			Due Date:<br>
			<input type="date" name="title" id="dateBox" required>
			<br><br>
			<center><input type="submit" name="Edit" value="Edit" onclick = "dbMod('e', document.getElementById('idBox').value); toggleForm()"></center>
			<input type = "hidden" id = "idBox"></input>
			<input type = "hidden" id = "compBox"></input>
			<br>
		</form>
		</td>
		</td>
		
		</tr>
		</table>
	</body>

</html>