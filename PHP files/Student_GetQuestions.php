<?php
	$conn=mysqli_connect("localhost","root","","students_network");
	$topicName = $_GET['TopicName'];

				$topicIdQuery = "SELECT ID FROM topic WHERE Name='$topicName'";
				$result = $conn->query($topicIdQuery);
   	 			$topicID = $result->fetch_array(MYSQLI_NUM);
			
				$quizIdQuery = "SELECT ID FROM quiz WHERE Topic_ID='$topicID[0]'";
				$result = $conn->query($quizIdQuery);
   	 			$quizID = $result->fetch_array(MYSQLI_NUM);

				$questionsQuery="SELECT Question FROM question WHERE Quiz_ID='$quizID[0]'";
				$result=$conn->query($questionsQuery);
				$questions = array();
				$questions["Questions"] = array();
				$row;
				while($row = mysqli_fetch_array($result))
				{
					$inst = array();
    				$inst["Question"] = $row["Question"];
    				array_push($questions["Questions"],$inst); 
				}
				echo json_encode($questions);
?>