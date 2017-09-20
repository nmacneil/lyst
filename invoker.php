<?php
include "config.php";
date_default_timezone_set("Canada/Newfoundland");

$id = $_REQUEST["id"];
$step = $_REQUEST["step"];

$query = mysqli_query($con,"SELECT * FROM ListItems WHERE listID='".$id."'");
			$numRows = mysqli_num_rows($query);

			if($numRows>0) 
			{
				$row = mysqli_fetch_assoc($query);
				$note_id = $row['listID'];
				$task_name = $row['task'];
				$task_description = $row['description'];
				$task_time = $row['due_date'];
				$completed = $row['completed'];
			}
			
			if($step == 'a')//step by step relays object to the main file to add to the edit window
				echo $task_name;
			if($step == 'b')
				echo $task_description;
			if($step == 'c')
				echo $task_time;
			if($step == 'd')
				echo $note_id;
			if($step == 'e')
				echo $completed;

?>