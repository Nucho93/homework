<?php
	require("php-includes/check-login.php");
	require("php-includes/functions.php");
	require("../php-includes/connect.php");

	$query=mysqli_query($con,"SELECT COUNT(*) FROM homework_topic");
	$row=mysqli_fetch_array($query);
	$topic_count=$row[0];

	$query=mysqli_query($con,"SELECT COUNT(*) FROM homework_task");
	$row=mysqli_fetch_array($query);
	$task_count=$row[0];

	$query=mysqli_query($con,"SELECT COUNT(*) FROM homework_user");
	$row=mysqli_fetch_array($query);
	$user_count=$row[0];

	$query=mysqli_query($con,"SELECT COUNT(*) FROM homework_user_task");
	$row=mysqli_fetch_array($query);
	$user_task_count=$row[0];
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Администратор беті</title>

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
                    <h1 class="page-header">Статистика</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			<div class="row">
				<div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Сайттағы ақпараттар саны
                        </div>
                        <div class="panel-body">
							<p><b>Тақырыптар:</b> <?=$topic_count?></p>
							<p><b>Тапсырмалар:</b> <?=$task_count?></p>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Сайттағы қолданушылар саны
                        </div>
                        <div class="panel-body">
                            <p><b>Оқушылар:</b> <?=$user_count?></p>
							<p><b>Оқушылар тапсырмалары:</b> <?=$user_task_count?></p>
                        </div>
                    </div>
                    <!-- /.col-lg-4 -->
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
