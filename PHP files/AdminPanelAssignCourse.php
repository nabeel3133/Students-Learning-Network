<?php
	$conn=mysqli_connect("localhost","root","","students_network");
	$instructor_id = $_GET['Instructor'];
	$course_id = $_GET['Course'];
	$course_name = $_GET['CourseName'];

				$query = "Select * from instructor_subjects where Instructor_ID='$instructor_id' and Subject_ID = '$course_id'";
				$result = $conn->query($query);
				if($result->num_rows > 0)
				{
				$json['AddedAlready'] = 'This course has already been assigned to this instructor';
				echo json_encode($json);
				mysqli_close($conn);
				}
				else
				{
					$query = "Insert into instructor_subjects (Instructor_ID, Subject_ID, Subject_Name) VALUES ( '$instructor_id','$course_id', '$course_name')";
					$inserted = mysqli_query($conn, $query);
					if($inserted == 1 )
					{
					$json['Success'] = 'Course assigned successfully to '.$instructor_id;
				    echo json_encode($json);
				    mysqli_close($conn);
					}
					else
					{
				$json['error'] = ' There was an error while assigning the instructor. Please try again!';
					echo json_encode($json);
				    mysqli_close($conn);
					}
				}
?>