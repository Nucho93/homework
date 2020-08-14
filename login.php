<?php
    session_start();
    require("php-includes/connect.php");
	require("php-includes/functions.php");

	$email=mysqli_real_escape_string($con,$_POST['email']);
	$password=mysqli_real_escape_string($con,$_POST['password']);

	$x=2;

	$query=mysqli_query($con,"SELECT * FROM homework_user WHERE `email`='$email' AND `pass`='$password'");
	if(mysqli_num_rows($query)>0 && $x<3){
		$row=mysqli_fetch_array($query);
		$_SESSION['userid']=$row['id'];
        $_SESSION['id']=session_id();
        $_SESSION['login_type']='user';
        echo "
            <script>
                window.location.assign('home.php');
            </script>
        ";
	}
	else if($x<2){
		echo "
            <script>
                alert('Қате, сайт әкімшісімен хабарласыңыз.');
                window.location.assign('index.php');
            </script>
        ";
	}
	else{
		echo "
            <script>
                alert('Пошта немесе пароль қате жазылған.');
                window.location.assign('index.php');
            </script>
        ";
	}
?>