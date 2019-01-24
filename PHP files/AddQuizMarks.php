<?php
	$conn=mysqli_connect("localhost","root","","students_network");

				$topicName = $_GET["TopicName"];
				$username = $_GET['Username'];

				$answer1 = $_GET["Answer1"];
				$answer2 = $_GET["Answer2"];
				$answer3 = $_GET["Answer3"];
				$answer4 = $_GET["Answer4"];
				$answer5 = $_GET["Answer5"];



				$Marks = 0;

				//Getting the quiz id		
				$quizIdQuery = "Select ID from quiz where Topic_Name='$topicName'";
				$result = $conn->query($quizIdQuery);
   	 			$quizID = $result->fetch_array(MYSQLI_NUM);

				$getAnswersQuery = "Select Correct_Answer from question where Quiz_ID='$quizID[0]'";
				$result2 = $conn->query($getAnswersQuery);
				$row;
				$Correct_Answers = array();
				while($row = mysqli_fetch_array($result2))
				{
					array_push($Correct_Answers,$row['Correct_Answer']);
				}
				if($Correct_Answers[0] == $answer1)
				{
					$Marks++;
				}
				if($Correct_Answers[1] == $answer2)
				{
					$Marks++;
				}
				if($Correct_Answers[2] == $answer3)
				{
					$Marks++;
				}
				if($Correct_Answers[3] == $answer4)
				{
					$Marks++;
				}
				if($Correct_Answers[4] == $answer5)
				{
					$Marks++;
				}
   	 			if ($Marks>3)
   	 			{
   	 				
   	 				$student2;
   	 				$topic;
   	 				$gettopic = "select Topic_ID from quiz where ID ='$quizID[0]'";
   	 				$execute = $conn->query($gettopic);
   	 				$temp = mysqli_fetch_array($execute);
   	 				$topic = $temp['Topic_ID'];
   	 				$instructor;
   	 				$sql = "select Student_ID from review where Marks<3";
   	 				$result = $conn->query($sql);
   	 				$row;
   	 				while ($row=mysqli_fetch_array($result))
   	 				{
   	 					//$quiz = $row['Quiz_ID'];
   	 					$student2 = $row['Student_ID'];
   	 					$sql2="select ID from session where Stud1_ID='$student2' or Stud2_ID = '$student2' and Topic_ID = '$topic'";
   	 					$result2 = $conn->query($sql2);
   	 					if ($result2->num_rows == 0)
   	 					{
   	 						$sql3 = "select Subject_ID from instructor_subjects where Subject_ID IN (select Course_ID from topic where ID ='$topic')";
   	 						$result3 = $conn->query($sql3);
   	 						$instrow = mysqli_fetch_array($result3);
   	 						$instructor = $instrow['Subject_ID'];
   	 						$addsession = "insert into sessions (Stud1_ID,Stud2_ID,Instructor_ID,Topic_ID) values('$username','$student2','$instructor','$topic')";
   	 						$conn->query($addsession);
   	 						break;
   	 					}
   	 				}
   	 			}
   	 			if ($Marks<3)
   	 			{
   	 				$student2;
   	 				$topic;
   	 				$gettopic = "select Topic_ID from quiz where ID ='$quizID[0]'";
   	 				$execute = $conn->query($gettopic);
   	 				$temp = mysqli_fetch_array($execute);
   	 				$topic = $temp['Topic_ID'];
   	 				$instructor;
   	 				$sql = "select Student_ID from review where Marks>3";
   	 				$result = $conn->query($sql);
   	 				$row;
   	 				while ($row=mysqli_fetch_array($result))
   	 				{
   	 					//$quiz = $row['Quiz_ID'];
   	 					$student2 = $row['Student_ID'];
   	 					$sql2="select ID from session where Stud1_ID='$student2' or Stud2_ID = '$student2' and Topic_ID = '$topic'";
   	 					$result2 = $conn->query($sql2);
   	 					if ($result2->num_rows == 0)
   	 					{
   	 						$sql3 = "select Instructor_ID from instructor_subjects where Subject_ID IN (select Course_ID from topic where ID ='$topic')";
   	 						echo $student2;
   	 						echo $username;
   	 						
   	 						echo $topic;
   	 						$result3 = $conn->query($sql3);
   	 						$instrow = mysqli_fetch_array($result3);
   	 						$instructor = $instrow['Instructor_ID'];
   	 						echo $instructor;
   	 						$addsession = "insert into session (Stud1_ID,Stud2_ID,Instructor_ID,Topic_ID) values('$username','$student2','$instructor',$topic)";
   	 						$conn->query($addsession);
   	 						break;
   	 					}
   	 				}
   	 			}
   	 			if ($Marks==3)
   	 			{
   	 				
   	 				$student2;
   	 				$topic;
   	 				$gettopic = "select Topic_ID from quiz where ID ='$quizID[0]'";
   	 				$execute = $conn->query($gettopic);
   	 				$temp = mysqli_fetch_array($execute);
   	 				$topic = $temp['Topic_ID'];
   	 				$instructor;
   	 				$sql = "select Student_ID from review where Marks=3";
   	 				$result = $conn->query($sql);
   	 				$row;
   	 				while ($row=mysqli_fetch_array($result))
   	 				{
   	 					//$quiz = $row['Quiz_ID'];
   	 					$student2 = $row['Student_ID'];
   	 					$sql2="select ID from session where Stud1_ID='$student2' or Stud2_ID = '$student2' and Topic_ID = '$topic'";
   	 					$result2 = $conn->query($sql2);
   	 					if ($result2->num_rows == 0)
   	 					{
   	 						$sql3 = "select Subject_ID from instructor_subjects where Subject_ID IN (select Course_ID from topic where ID ='$topic')";
   	 						$result3 = $conn->query($sql3);
   	 						$instrow = mysqli_fetch_array($result3);
   	 						$instructor = $instrow['Subject_ID'];
   	 						$addsession = "insert into sessions (Stud1_ID,Stud2_ID,Instructor_ID,Topic_ID) values('$username','$student2','$instructor','$topic')";
   	 						$conn->query($addsession);
   	 						break;
   	 					}
   	 				}
   	 			}
				//Inserting the marks of the student.
				$InsertMarksQuery = "INSERT INTO review (Quiz_ID, Student_ID, Marks) VALUES 
				( '$quizID[0]', '$username', '$Marks')";
				$result = $conn->query($InsertMarksQuery);
				$json['Success'] = 'You have scored '.$Marks. ' out of 5 marks in this Quiz';
				
				echo json_encode($json);
			
?>