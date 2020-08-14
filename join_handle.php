<?php
	require("php-includes/connect.php");
	require("php-includes/functions.php");

	$fname=mysqli_real_escape_string($con,$_POST['fname']);
    $sname=mysqli_real_escape_string($con,$_POST['sname']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $password=mysqli_real_escape_string($con,$_POST['password']);

	$flag=0;
	if($email != "" && $password != "" && $fname != "" && $sname != ""){
		if(email_check($email)){
			echo "
				<script>
					alert('Бұл пошта қолданыста, басқасын таңдаңыз');
					window.location.assign('join.php');
				</script>
			";
		}
		else{
			$flag=1;
		}
	}
	else{
		echo "
			<script>
				alert('Барлығын толтырыңыз');
				window.location.assign('join.php');
			</script>
		";
	}

	if($flag==1){
		mysqli_query($con,"INSERT INTO homework_user(`email`,`pass`,`fname`,`sname`) VALUES('$email','$password','$fname','$sname')");
		echo "
			<script>
				alert('Тіркелу сәтті!');
				window.location.assign('index.php');
			</script>
		";
	}
?>