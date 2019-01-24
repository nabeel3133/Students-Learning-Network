<?php
	$conn=mysqli_connect("localhost","root","","students_network");

				$topicName = $_GET["TopicName"];

				$question1 = $_GET["Question1"];
				$answer1 = $_GET["Answer1"];

				$question2 = $_GET["Question2"];
				$answer2 = $_GET["Answer2"];

				$question3 = $_GET["Question3"];
				$answer3 = $_GET["Answer3"];

				$question4 = $_GET["Question4"];
				$answer4 = $_GET["Answer4"];

				$question5 = $_GET["Question5"];
				$answer5 = $_GET["Answer5"];

				//Selecting the topic id from topic name
				$topicIdQuery = "SELECT ID FROM topic WHERE Name='$topicName'";
				$result = $conn->query($topicIdQuery);
   	 			$topicID = $result->fetch_array(MYSQLI_NUM);

				$query = "Select * from quiz where Topic_ID='$topicID[0]'";
				$result = $conn->query($query);
				if($result->num_rows > 0)
				{
				$json['AddedAlready'] = 'The quiz for this topic has already been created';
				echo json_encode($json);
				mysqli_close($conn);
				}

				else
				{
				//Inserting the quiz based on the topic id				
				$InsertQuizQuery = "INSERT INTO quiz (Topic_ID, Marks, Topic_Name) VALUES ( '$topicID[0]', 5, '$topicName')";
				$result = $conn->query($InsertQuizQuery);

				//Getting the quiz id		
				$GetQuizIDQuery = "SELECT ID FROM `quiz` WHERE ID=(SELECT MAX(ID) FROM `quiz`)";
				$result = $conn->query($GetQuizIDQuery);
				$quizID = $result->fetch_array(MYSQLI_NUM);

				//Inserting the questions based on the quiz ID.		
				$InsertQuestionsQuery = "INSERT INTO question (Quiz_ID, Marks,Question, Correct_Answer) VALUES 
				( '$quizID[0]', 1, '$question1', '$answer1'), 
				( '$quizID[0]', 1, '$question2', '$answer2'),
				( '$quizID[0]', 1, '$question3', '$answer3'), 
				( '$quizID[0]', 1, '$question4', '$answer4'), 
				( '$quizID[0]', 1, '$question5', '$answer5')";

				$result = $conn->query($InsertQuestionsQuery);
				
				$json['Success'] = 'Quiz Created Successfully';
				echo json_encode($json);
				}


?>