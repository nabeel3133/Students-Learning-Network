<?php
	$conn=mysqli_connect("localhost","root","","students_network");
	$instructor_id = $_GET['Username'];

				$query="Select Subject_ID from instructor_subjects where Instructor_ID='$instructor_id'";
				$Courses=$conn->query($query);
				$response = array();
				$row;
				while($row = mysqli_fetch_array($Courses))
				{
    				array_push($response,$row["Subject_ID"]); 
				}
				$theResponse = array();
				$theResponse["TopicNames"] = array();
				foreach ($response as $value)
				{
    				$query="Select Name from topic where Course_ID='$value'";
					$Topics=$conn->query($query);
					$row;
					while($row = mysqli_fetch_array($Topics))
					{
						$inst = array();
    					$inst["Name"] = $row["Name"];
	    				array_push($theResponse["TopicNames"], $inst);
					}
				}

				echo json_encode($theResponse);
?>