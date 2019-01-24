<?php
	$conn=mysqli_connect("localhost","root","","students_network");
				$row;
				$row2;
				$AllCourses="Select Name from course";
				$result2=$conn->query($AllCourses);
				$All_topics = array();
				while($row2 = mysqli_fetch_array($result2))
				{
					$course_name = $row2["Name"];	
					$All_topics["$course_name"] = array();
					$get_courseID = "Select ID from course WHERE Name='$course_name'";
					$result=$conn->query($get_courseID);
					$courseID = mysqli_fetch_array($result);
					$TopicQuery="Select Name from topic where Course_ID=$courseID[0]";
					$result=$conn->query($TopicQuery);
					while($row = mysqli_fetch_array($result))
					{
						$inst = array();
	    				$inst["Name"] = $row["Name"];
	    				array_push($All_topics["$course_name"],$inst); 
					}					
				}

				echo json_encode($All_topics);
?>