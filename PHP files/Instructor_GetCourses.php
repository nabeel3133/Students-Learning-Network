<?php
	$conn=mysqli_connect("localhost","root","","students_network");
	$instructor_id = $_GET['Username'];

				$query="Select Subject_Name from instructor_subjects where Instructor_ID='$instructor_id'";
				$Courses=$conn->query($query);
				$response = array();
				$response["Courses"] = array();
				$row;
				while($row = mysqli_fetch_array($Courses))
				{
    				$inst = array();
    				$inst["Subject_Name"] = $row["Subject_Name"];
    				array_push($response["Courses"], $inst);
				}
				echo json_encode($response);
?>