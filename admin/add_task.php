<?php
	require("php-includes/check-login.php");
	require("../php-includes/connect.php");
	$query=mysqli_query($con,"SELECT * FROM homework_topic WHERE `status`='active'");
	
	$month = date('m');
	$day = date('d');
	$year = date('Y');
	$today = $year . '-' . $month . '-' . $day;
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Жаңа тапсырма қосу беті</title>

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
                    <h1 class="page-header">Толтыр</h1>
                </div>
                <!-- /.col-lg-12 -->
				<div class="row">
					<div class="col-lg-4">
						<div class="panel panel-default">
							<div class="panel-body">
								<form role="form" method="post" action="add_task_handle.php">
									<input type="hidden" name="MAX_FILE_SIZE" value="3145728" />
									<fieldset>
										<div class="form-group">
                                            <label>Тақырып</label>
                                            <select class="form-control" name="topic_id">
												<?php
													while($row=mysqli_fetch_array($query)){
														$topic_id=$row['id'];
														$topic_title=$row['title'];
														
														echo "
															<option value='$topic_id'>$topic_title</option>
														";
													}
												?>
                                            </select>
                                        </div>
										<div class="form-group">
                                            <label>Тапсырма</label>
                                            <textarea class="form-control" required name="content" rows="3"></textarea>
                                        </div>
										<div class="form-group">
                                            <label>Тапсыру уақыты</label>
                                            <input class="form-control" type="date" name="deadline" value="<?=$today?>">
                                        </div>
										<!-- Change this to a button or input when using this as a form -->
										<button type="submit" class="btn btn-lg btn-success btn-block">Қосу</button>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
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
