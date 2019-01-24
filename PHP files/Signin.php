<?php
	$conn=mysqli_connect("localhost","root","","students_network");
	$username = $_POST['Username'];
	$password = $_POST['Password'];
	$type = $_POST['Type'];

		if(!empty($username) && !empty($password) && !empty($type))
		{
			$query = "Select * from user where Username='$username' and Password = '$password' and Type = '$type'";
			$result = $conn->query($query);
			if($result->num_rows > 0)
			{
				$json['Success'] = 'Signed in successfully '.$username;
				echo json_encode($json);
				mysqli_close($conn);
			}
			else
			{
				$json['Invalid'] = 'Invalid Login Details';
				echo json_encode($json);
				mysqli_close($conn);
			}
		}
		else
		{
			$json2['empty'] = 'You must enter all inputs';
			echo json_encode($json2);
		}
?>