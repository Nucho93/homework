<?php
    session_start();
    require("../php-includes/connect.php");
    require("../php-includes/functions.php");

	$user_task_id=mysqli_real_escape_string($con,$_GET['user_task_id']);
	$action=mysqli_real_escape_string($con,$_GET['action']);

	if($action=='approved'){
		mysqli_query($con,"UPDATE homework_user_task SET `status`='approved' WHERE `id`=$user_task_id");
	}
	else if($action=='declined'){
		mysqli_query($con,"UPDATE homework_user_task SET `status`='declined' WHERE `id`=$user_task_id");
	}

	header("Location: user_tasks.php");
?>