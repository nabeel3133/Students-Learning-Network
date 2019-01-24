<?php
	$conn=mysqli_connect("localhost","root","","students_network");
	$username = $_POST['Username'];
	$password = $_POST['Password'];
	$type = $_POST['Type'];

		if(!empty($username) && !empty($password) && !empty($type))
		{
			$query = "Select * from user where Username='$username' and Type = '$type'";
			$result = $conn->query($query);
			if($result->num_rows > 0)
			{
				$json['alreadyExist'] = 'Username already exists';
				echo json_encode($json);
				mysqli_close($conn);
			}
			else
			{
				$query = "Insert into user (Username, Password, Type) VALUES ( '$username','$password', '$type')";
				$inserted = mysqli_query($conn, $query);
				if($inserted == 1 )
				{
				$json['Success'] = 'Signed up successfully '.$username;
			    echo json_encode($json);
			    mysqli_close($conn);
				}
				else
				{
				$json['error'] = ' Error signing up';
				echo json_encode($json);
			    mysqli_close($conn);
				}
			}
		}
		else
		{
			$json2['empty'] = 'You must enter all inputs';
			echo json_encode($json2);
		}
?>