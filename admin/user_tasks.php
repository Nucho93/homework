<?php
	require("php-includes/check-login.php");
	require("php-includes/functions.php");
	require("../php-includes/connect.php");
	
	if(isset($_GET['status'])){
		$status=$_GET['status'];
	}
	else{
		$status='initiated';
	}

	$query=mysqli_query($con,"SELECT * FROM homework_user_task WHERE `status`='$status'");
	$task_count=0;
	if(mysqli_num_rows($query)>0){
		$task_count=mysqli_num_rows($query);
	}
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Оқушылар тапсырмалары</title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Blank -->

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">

	<style>
		a.btn{
			margin: 2px;
		}
	</style>
	
</head>

<body>

    <div id="wrapper">
		<?php require("php-includes/menu.php");?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Енгізілген тапсырмалар: <?=$task_count?></h1>
                </div>
                <!-- /.col-lg-12 -->
				
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="display: flex; align-items: center;">
							<p style="margin:0;">Өткізілген тапсырмалар тізімі</p>
								<div class="form-group" style="margin: 0 0 0 15px;">
									<select class="form-control" id="status" onchange="statusChange()">
										<?php
											if($status=='initiated'){
												echo "
													<option value='initiated' selected>Қарастырылуда</option>
													<option value='approved'>Қабылданған</option>
													<option value='declined'>Қайтарылған</option>
												";
											}
											else if($status=='approved'){
												echo "
													<option value='initiated'>Қарастырылуда</option>
													<option value='approved' selected>Қабылданған</option>
													<option value='declined'>Қайтарылған</option>
												";
											}
											else if($status=='declined'){
												echo "
													<option value='initiated'>Қарастырылуда</option>
													<option value='approved'>Қабылданған</option>
													<option value='declined' selected>Қайтарылған</option>
												";
											}
										?>
									</select>
								</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Тақырып</th>
                                            <th>Тапсырма</th>
                                            <th>Өткізу уақыты</th>
                                            <th>Оқушы</th>
											<th>Оқушы жібергені</th>
											<th>Жіберген уақыты</th>
											<th>Әрекет</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$i=1;
										if($task_count==0){
											echo "
												<tr>
													<td colspan='8'>Тапсырмалар әлі салынбаған</td>
												</tr>
											";
										}
										while($row=mysqli_fetch_array($query)){
											$user_task_id=$row['id'];
											$task_id=$row['task_id'];
											$user_id=$row['user_id'];
											$doc="topic_docs/".$row['doc'];	
											$upload_date=$row['upload_date'];	
											$task_data=get_task_data($task_id);
											$topic_data=get_topic_data($task_data['topic_id']);
											$user_data=get_user_data($user_id);
											$topic_title=$topic_data['title'];
											$task_content=$task_data['content'];
											$task_deadline=$task_data['deadline'];
											$user_email=$user_data['email'];
											$user_fname=$user_data['fname'];
											$user_sname=$user_data['sname'];

									?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td><?=$topic_title?></td>
                                            <td><?=$task_content?></td>
                                            <td><?=$task_deadline?></td>
                                            <td>
												<?=$user_email?>
												<?=$user_fname?>
												<?=$user_sname?>
											</td>
											<td><a href="<?=$doc?>">Жүктеу</a></td>
                                            <td><?=$upload_date?></td>
											<td>
												<a type="button" class="btn btn-success" href="task_action.php?user_task_id=<?=$user_task_id?>&action=approved">Дұрыс</a>
												<a type="button" class="btn btn-danger" href="task_action.php?user_task_id=<?=$user_task_id?>&action=declined">Қате</a>
											</td>
                                        </tr>
										
									<?php
											$i++;
										}
									?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	
	<script>
		function statusChange(){
			var status=document.querySelector("#status");
			var statusValue=status.value;
			window.location.assign("user_tasks.php?status="+statusValue);
		}
	</script>

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Blank -->

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Blank - Use for reference -->

</body>

</html>
