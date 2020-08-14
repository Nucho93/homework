<?php
	require("php-includes/check-login.php");
	require("../php-includes/connect.php");
	$query=mysqli_query($con,"SELECT * FROM homework_topic WHERE `status`='active'");
	$topic_count=0;
	if(mysqli_num_rows($query)>0){
		$topic_count=mysqli_num_rows($query);
	}
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Тақырыптар</title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Blank -->

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">
		<?php require("php-includes/menu.php");?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Енгізілген тақырыптар: <?=$topic_count?></h1>
                </div>
                <!-- /.col-lg-12 -->
				
				<?php
					if($topic_count==0){
						echo "
							<div class='col-lg-12'>
								<p>Тақырыптар әлі салынбаған</p>
							</div>
						";
					}
					while($row=mysqli_fetch_array($query)){
						$topic_id=$row['id'];
						$title=$row['title'];
						$appendix=$row['appendix'];
						$pic="topic_pics/".$row['pic'];
						$doc="topic_docs/".$row['doc'];	
						$upload_date=$row['upload_date'];				
					
				?>
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="display: flex; justify-content: space-between;">
							<p style="margin-bottom:0"><?=$title?></p>
							<a href="delete_topic.php?topic_id=<?=$topic_id?>">Жою</a>
                        </div>
                        <div class="panel-body">
							<div class="col-lg-4">
								<img src="<?=$pic?>" style="width:100%">
							</div>
                            <div class="col-lg-4">
								<p><?=$appendix?></p>
							</div>
							<div class="col-lg-4">
								<div class="panel panel-default">
									<div class="panel-heading">
										Тапсырмалар
									</div>
									<!-- /.panel-heading -->
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Тапсырма</th>
														<th>Уақыты</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$i=1;
														$task_query=mysqli_query($con,"SELECT * FROM homework_task WHERE `topic_id`=$topic_id");
														while($task_row=mysqli_fetch_array($task_query)){
															$content=$task_row['content'];
															$deadline=$task_row['deadline'];
													?>
													<tr>
														<td><?=$i?></td>
														<td><?=$content?></td>
														<td><?=$deadline?></td>
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
							</div>
                        </div>
                        <div class="panel-footer">
							<small>Сайтқа қойылған уақыты: <?=$upload_date?> <a href="<?=$doc?>">Жүктеу</a></small>
                        </div>
                    </div>
                </div>
				<?php
					
					}
				?>
				
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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
