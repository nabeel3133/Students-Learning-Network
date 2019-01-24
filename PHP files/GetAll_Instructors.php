<?php
	$conn=mysqli_connect("localhost","root","","students_network");
				$query="Select Username from user where Type='Instructor'";
				$Instructors=$conn->query($query);
				$response = array();
				$response["Instructors"] = array();
				$row;
				while($row = mysqli_fetch_array($Instructors))
				{
    				$inst = array();
    				$inst["Username"] = $row["Username"];
    				array_push($response["Instructors"], $inst);
				}
				echo json_encode($response);
?>