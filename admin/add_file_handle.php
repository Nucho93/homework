<?php
    session_start();
    require("../php-includes/connect.php");
    require("../php-includes/functions.php");
	
	$title=mysqli_real_escape_string($con,$_POST['title']);
	$title=trim($title);
	$title=stripslashes($title);
	$title=htmlspecialchars($title);

	$appendix=mysqli_real_escape_string($con,$_POST['appendix']);
	$appendix=trim($appendix);
	$appendix=stripslashes($appendix);
	$appendix=htmlspecialchars($appendix);

	$pic_name=$_FILES['pic']['name'];
	$pic_tmp=$_FILES['pic']['tmp_name'];
	$pic_format=mb_substr(strrchr($pic_name, '.'), 1);
	$pic_size=$_FILES['pic']['size'];

	$doc_name=$_FILES['doc']['name'];
	$doc_tmp=$_FILES['doc']['tmp_name'];
	$doc_format=mb_substr(strrchr($doc_name, '.'), 1);
	$doc_size=$_FILES['doc']['size'];

	$flag=0;

	//validation
	if($title!='' && $appendix!='' && $pic_name!='' && $doc_name!=''){
		if($pic_size<3145728 && $doc_size<3145728){
			if($pic_format=='jpg' || $pic_format=='JPG' || $pic_format=='jpeg' || $pic_format=='JPEG'){
				if($doc_format=='docx' || $doc_format=='DOCX' || $doc_format=='doc' || $doc_format=='DOC'){
					$flag=1;
				}
				else{
					echo "
						<script>
							alert('Файл форматы doc не docx болу керек.');
							window.location.assign('add_file.php');
						</script>
					";
				}
			}
			else{
				echo "
					<script>
						alert('Сурет форматы jpg не jpeg болу керек.');
						window.location.assign('add_file.php');
					</script>
				";
			}
		}
		else{
			echo "
				<script>
					alert('Файлдар салмақтары тым үлкен!');
					window.location.assign('add_file.php');
				</script>
			";
		}
	}
	else{
		echo "
			<script>
				alert('Барлығын толтыр!');
				window.location.assign('add_file.php');
			</script>
		";
	}

	if($flag==1){
		mysqli_query($con,"INSERT INTO homework_topic(`title`,`appendix`) VALUES('$title','$appendix')");
		$last_insert=mysqli_fetch_array(mysqli_query($con,"SELECT LAST_INSERT_ID()"));
		$last_id=$last_insert[0];
		//moving pic
		$from=$pic_tmp;
		$pic_new_name=$last_id.'.'.$pic_format;
		$to=dirname(__FILE__).'/topic_pics/'.basename($pic_new_name);
		if(!move_uploaded_file($from,$to)){
			exit("upload error1");
		}
		//moving doc
		$from=$doc_tmp;
		$doc_new_name=$last_id.'.'.$doc_format;
		$to=dirname(__FILE__).'/topic_docs/'.basename($doc_new_name);
		if(!move_uploaded_file($from,$to)){
			exit("upload error2");
		}
		//updating record, setting where file is
		mysqli_query($con,"UPDATE homework_topic SET `pic`='$pic_new_name',`doc`='$doc_new_name' WHERE `id`=$last_id");
		
		header("Location: all_topics.php");
	}
?>