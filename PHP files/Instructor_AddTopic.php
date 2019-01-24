<?php
	$conn=mysqli_connect("localhost","root","","students_network");
	$course_name = $_GET['CourseName'];
	$topic_name = $_GET['TopicName'];

				$query = "Select ID from course where Name='$course_name'";
				$result = $conn->query($query);
				$course_id = $result->fetch_array(MYSQLI_NUM);

				$query = "Select * from topic where Course_ID='$course_id[0]' and Name = '$topic_name'";
				$result = $conn->query($query);
				if($result->num_rows > 0)
				{
				$json['AddedAlready'] = 'This topic has already been added for this course';
				echo json_encode($json);
				mysqli_close($conn);
				}

				else
				{
				$query = "Insert into topic (Course_ID, Name) VALUES ( '$course_id[0]', '$topic_name')";
				$inserted = mysqli_query($conn, $query);
					if($inserted == 1)
					{
					$json['Success'] = 'Topic addded successfully';
				    echo json_encode($json);
					mysqli_close($conn);
					}
					else
					{
					$json['error'] = 'There was an error while adding the topic. Please try again!';
					echo json_encode($json);
				    mysqli_close($conn);
					}
				}
?>