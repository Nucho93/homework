<?php
    function email_check($email){
        global $con;

        $query=mysqli_query($con,"SELECT * FROM homework_user WHERE email='$email'");
        if(mysqli_num_rows($query)>0){
            return true;
        }
        else{
            return false;
        }
    }

	function get_user_task_data($task_id,$user_id){
		global $con;
		$data=array();
		
		$query=mysqli_query($con,"SELECT * FROM homework_user_task WHERE `task_id`=$task_id AND `user_id`=$user_id");
		$row=mysqli_fetch_array($query);
		$data['id']=$row['id'];
		$data['task_id']=$row['task_id'];
		$data['user_id']=$row['user_id'];
		$data['doc']=$row['doc'];
		$data['upload_date']=$row['upload_date'];
		$data['status']=$row['status'];
		
		return $data;
	}

	function get_task_data($task_id){
		global $con;
		$data=array();
		
		$query=mysqli_query($con,"SELECT * FROM homework_task WHERE `id`=$task_id");
		$row=mysqli_fetch_array($query);
		$data['id']=$row['id'];
		$data['topic_id']=$row['topic_id'];
		$data['content']=$row['content'];
		$data['deadline']=$row['deadline'];
		$data['status']=$row['status'];
		
		return $data;
	}

	function get_topic_data($topic_id){
		global $con;
		$data=array();
		
		$query=mysqli_query($con,"SELECT * FROM homework_topic WHERE `id`=$topic_id");
		$row=mysqli_fetch_array($query);
		$data['id']=$row['id'];
		$data['title']=$row['title'];
		$data['appendix']=$row['appendix'];
		$data['pic']=$row['pic'];
		$data['doc']=$row['doc'];
		$data['upload_date']=$row['upload_date'];
		$data['status']=$row['status'];
		
		return $data;
	}

	function get_user_data($user_id){
		global $con;
		$data=array();
		
		$query=mysqli_query($con,"SELECT * FROM homework_user WHERE `id`=$user_id");
		$row=mysqli_fetch_array($query);
		$data['id']=$row['id'];
		$data['email']=$row['email'];
		$data['pass']=$row['pass'];
		$data['fname']=$row['fname'];
		$data['sname']=$row['sname'];
		
		return $data;
	}
?>