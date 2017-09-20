
<?php 
include "config.php";
date_default_timezone_set("Canada/Newfoundland");
session_start();

//get parameters from URL


if($_REQUEST["q"] != 'l')//q is used to denote which type of operation is being used
	{
	$q = $_REQUEST["q"];//variables are taken from the URL
	$title = $_REQUEST["title"];
	$disc = $_REQUEST["disc"];
	$date = $_REQUEST["date"];
	$comp = $_REQUEST["comp"];
	if($_REQUEST["id"] != null)
		$id = $_REQUEST["id"];
	
	if($q == 'c')//c denotes the act of completing a task
		$query = mysqli_query($con, "UPDATE ListItems SET completed='1' WHERE listID='".$id."'");
	
	if($q == 'd')//d denote the act of deleting a task
		$query = mysqli_query($con, "DELETE FROM ListItems WHERE listID='".$id. "'");
	
	
	if($q == 'u')//u denote the act of undoing a completion
		$query = mysqli_query($con, "UPDATE ListItems SET completed='0' WHERE listID='".$id."'");
	
	if($q== 'e')//e denotes the act of editing a task
		{
			console.log("hello");
		$query = mysqli_query($con, "UPDATE ListItems SET task='".$title."', description='".$disc."', due_date='".$date."', completed='".$comp."'
		WHERE listID='".$id."'");
		}
	}





















//At the end the entry view is recreated to ensure information is up to date

			$query = mysqli_query($con,"SELECT * FROM ListItems WHERE completed=0 AND owner='".$_SESSION['userID']."' ORDER BY due_date ASC");
			$numRows = mysqli_num_rows($query);

			if($numRows>0) {
				while($row = mysqli_fetch_assoc($query)) {

					$note_id = $row['listID'];
					$task_name = $row['task'];
					$task_description = $row['description'];
					$task_time = $row['due_date'];
					$completed = $row['completed'];

					if($task_time < date('Y-m-d')){
						echo '<table bordercolor="#696969" frame="box" style="table-layout:fixed; border-collapse: collapse; width:320px" id = "'.$note_id.'" >
							<tr style="background-color: #ffb7b7">';
					} else if($task_time == date('Y-m-d')) {
						echo '<table bordercolor="#696969" frame="box" style="table-layout:fixed; border-collapse: collapse; width:320px" id = "'.$note_id.'">
							<tr style="background-color: #ffcc99">';
					} else {
						echo '<table bordercolor="#696969" frame="box" style="table-layout:fixed; border-collapse: collapse; width:320px" id = "'.$note_id.'">
							<tr style="background-color: #ffffe0">';				
					}

					echo '<th style="padding:10px; word-wrap: break-word" colspan ="2">'.$task_name.'</th>
							<th style="width:10%; cursor: pointer; cursor: hand" onclick = "invokeEdit1(this.parentNode.parentNode.parentNode.id); toggleForm()">&#9998</th>
							<th style="width:10%; color:#c40d0d; cursor: pointer; cursor: hand" onclick = "dbMod(\'d\', this.parentNode.parentNode.parentNode.id)">&#10008</th>
							</tr>
							<tr>
							<td style="padding:10px; word-wrap: break-word; 	background-color:#F5F5F5" height="100" colspan="4">
							<div class=scrollable>
								<p><pre>'.$task_description.'</pre></p>
							</div>
							</td>
							</tr>
							<tr style="background-color: #e0e0e5">
								<th colspan="3">'.$task_time.'</th>
								<th style="color: #1e8e1b; cursor: pointer; cursor: hand" onclick = "dbMod(\'c\', this.parentNode.parentNode.parentNode.id)">&#10004</th>
							</tr>
							</table><br>';
				}
			}

			$queryCompleted = mysqli_query($con,"SELECT * FROM ListItems WHERE completed=1 AND owner='".$_SESSION['userID']."' ORDER BY due_date ASC");
			$numRowsCompleted = mysqli_num_rows($queryCompleted);
			if($numRowsCompleted>0) {
				while($row = mysqli_fetch_assoc($queryCompleted)) {
					$note_id = $row['listID'];
					$task_name = $row['task'];
					$task_description = $row['description'];
					$task_time = $row['due_date'];
					$completed = $row['completed'];
					
					echo '<table bordercolor="#696969" frame="box" style="table-layout:fixed; border-collapse: collapse; width:320px" id = "'.$note_id.'">
							<tr style="background-color: #aee0a6">
							<th style="padding:10px; word-wrap: break-word" colspan ="2">'.$task_name.'</th>
							<th style="width:10%; cursor: pointer; cursor: hand" onclick = "invokeEdit1(this.parentNode.parentNode.parentNode.id)">&#9998</th>
							<th style="width:10%; color:#c40d0d; cursor: pointer; cursor: hand" onclick = "dbMod(\'d\', this.parentNode.parentNode.parentNode.id)">&#10008</th>
							</tr>
							<tr>
							<td style="padding:10px; word-wrap: break-word; 	background-color:#F5F5F5" height="100" colspan="4">
							<div class=scrollable>
								<p><pre>'.$task_description.'</pre></p>
							</div>
							</td>
							</tr>
							<tr style="background-color: #e0e0e5">
								<th colspan="3">'.$task_time.'</th>
								<th style="color: #027aa6; cursor: pointer; cursor: hand" onclick = "dbMod(\'u\', this.parentNode.parentNode.parentNode.id)">&#9664</th>
							</tr>
							</table><br>';	
				}
			}
		?>