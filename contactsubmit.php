<?php

$firstname= $_POST['firstname'];
$lastname= $_POST['lastname'];
$country= $_POST['country'];
$subject= $_POST['subject'];




if(!empty($firstname) || !empty($lastname) || !empty($country) || !empty($subject))
 {
	 $host= "localhost";
	 $dbusername="root";
	 $dbpassword="password";
	 $dbname="recipe";
	 
	 //create connection
	 $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
	 if(mysqli_connect_error()){
		die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
		}else{
			$SELECT = "select contactID from contact Where contactID = ? Limit 1";
			$INSERT = "insert into contact (firstname,lastname,country,subject) values (?,?,?,?)";
			
			//prepare statement
			$stmt = $conn->prepare($SELECT);
			$stmt->bind_param("s",$username);
			$stmt->execute();
			$stmt->bind_result($username);
			$stmt->store_result();
			$rnum = $stmt->num_rows;
			
			if ($rnum==0){
				$stmt->close();
				$stmt = $conn->prepare($INSERT);
				$stmt->bind_param("ssss", $firstname, $lastname, $country, $subject);
				$stmt->execute();
				echo "Thank you for sending a message! You will receive a reply soon.";
				//header('location: newhomepage.html');
			}else{
				echo "Unable to send message, please try again.";
			}
			$stmt->close();
			$conn->close();
			}
 }
 else{
	 echo "All fields are required.";
	 die();
 }
 ?>