<?php
	$conn=mysqli_connect("localhost","root","","students_network");
	$username = $_GET['Username'];
	$topicName = $_GET['TopicName'];

				//Getting the Topic ID		
				// $GetTopicIDQuery = "SELECT ID FROM `topic` WHERE Name='$topicName'";
				// $result = $conn->query($GetTopicIDQuery);
				// $TopicID = $result->fetch_array(MYSQLI_NUM);

				//Getting the Quiz ID		
				$GetQuizIDQuery = "SELECT ID FROM `quiz` WHERE Topic_Name='$topicName'";
				$quizExists = $conn->query($GetQuizIDQuery);
				$QuizID = $quizExists->fetch_array(MYSQLI_NUM);

				if($quizExists->num_rows == 0)
				{
				$json['QuizNotCreated'] = 'The Quiz is not yet created for this topic';
				echo json_encode($json);
				mysqli_close($conn);	
				}
				else
				{
					$checkAttemptQuery = "Select * from review where Quiz_ID=$QuizID[0] and Student_ID='$username'";
					$WhetherAttemptedAlready=$conn->query($checkAttemptQuery);
					if($WhetherAttemptedAlready->num_rows > 0)
					{
						$checkMarksQuery = "Select Marks from review where Quiz_ID='$QuizID[0]' and Student_ID='$username'";
						$result=$conn->query($checkMarksQuery);
						$Marks = mysqli_fetch_array($result);
						$json['AlreadyAttempted'] = 'You have already attempted the quiz for this Topic. Your marks in this quiz are: '.$Marks[0];
						echo json_encode($json);
						mysqli_close($conn);
					}
					else
					{
					$json['Success'] = 'Opening the quiz for topic '.$topicName;
					echo json_encode($json);
					mysqli_close($conn);
					}					
				}
?>