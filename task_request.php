<?php
    session_start();
    require("php-includes/connect.php");
    require("php-includes/functions.php");

	$user_id=$_SESSION['userid'];
	//echo $user_id;

	$doc_name=$_FILES['doc']['name'];
	$doc_tmp=$_FILES['doc']['tmp_name'];
	$doc_format=mb_substr(strrchr($doc_name, '.'), 1);
	$doc_size=$_FILES['doc']['size'];

	$task_id=$_GET['task_id'];
	$task_id=trim($task_id);
	$task_id=stripslashes($task_id);
	$task_id=htmlspecialchars($task_id);

	$topic_id=$_GET['topic_id'];
	$topic_id=trim($topic_id);
	$topic_id=stripslashes($topic_id);
	$topic_id=htmlspecialchars($topic_id);

	$flag=0;

	//validation
	if($doc_format=='docx' || $doc_format=='DOCX' || $doc_format=='doc' || $doc_format=='DOC'){
		$flag=1;
	}
	else{
		echo "
			<script>
				alert('Файл форматы doc не docx болу керек.');
				window.location.assign('topic.php?topic_id=$topic_id');
			</script>
		";
	}

	if($flag==1){
		mysqli_query($con,"INSERT INTO homework_user_task(`task_id`,`user_id`) VALUES($task_id,$user_id)");
		$last_insert=mysqli_fetch_array(mysqli_query($con,"SELECT LAST_INSERT_ID()"));
		$last_id=$last_insert[0];
		//moving doc
		$from=$doc_tmp;
		$doc_new_name=$last_id.'.'.$doc_format;
		$to=dirname(__FILE__).'/admin/topic_tasks/'.basename($doc_new_name);
		if(!move_uploaded_file($from,$to)){
			exit("upload error2");
		}
		//updating record, setting where file is
		mysqli_query($con,"UPDATE homework_user_task SET `doc`='$doc_new_name' WHERE `id`=$last_id");
		
		echo "
			<script>
				alert('Файл жіберілді');
				window.location.assign('topic.php?topic_id=$topic_id');
			</script>
		";
	}
?>