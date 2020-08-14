<?php
    session_start();
    require("../php-includes/connect.php");
    require("../php-includes/functions.php");
	
	$topic_id=mysqli_real_escape_string($con,$_POST['topic_id']);
	$topic_id=trim($topic_id);
	$topic_id=stripslashes($topic_id);
	$topic_id=htmlspecialchars($topic_id);

	$content=mysqli_real_escape_string($con,$_POST['content']);
	$content=trim($content);
	$content=stripslashes($content);
	$content=htmlspecialchars($content);

	$deadline=mysqli_real_escape_string($con,$_POST['deadline']);
	$deadline=trim($deadline);
	$deadline=stripslashes($deadline);
	$deadline=htmlspecialchars($deadline);

	$flag=0;

	//validation
	if($topic_id!='' && $content!='' && $deadline!=''){
		$flag=1;
	}
	else{
		echo "
			<script>
				alert('Барлығын толтыр!');
				window.location.assign('add_task.php');
			</script>
		";
	}

	if($flag==1){
		//echo $topic_id.$content.$deadline;
		mysqli_query($con,"INSERT INTO homework_task(`topic_id`,`content`,`deadline`) VALUES('$topic_id','$content','$deadline')");
		
		header("Location: add_task.php");
	}
?>