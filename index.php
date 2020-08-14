<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Сайтқа кіру</title>

    <!-- Core CSS - Include with every page -->
    <link href="admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="admin/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="admin/css/sb-admin.css" rel="stylesheet">
	
	<style>
		body{
			background-image: url(images/index_bg.jpeg);
			background-size: cover;
			background-repeat: no-repeat;
		}
	</style>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Пошта мен парольді енгізіңіз</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="login.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Пошта" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Пароль" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
								<p><a href="join.php">Тіркелу</a></p>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Кіру</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="admin/js/jquery-1.10.2.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script src="admin/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="admin/js/sb-admin.js"></script>

</body>

</html>
