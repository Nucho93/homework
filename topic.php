<?php
	require("php-includes/check-login.php");
	require("php-includes/connect.php");
	require("php-includes/functions.php");

	$user_id=$_SESSION['userid'];
	$topic_id=3;
	if(isset($_GET['topic_id'])){
		$topic_id=$_GET['topic_id'];
		$topic_id=trim($topic_id);
		$topic_id=stripslashes($topic_id);
		$topic_id=htmlspecialchars($topic_id);
	}
	$query=mysqli_query($con,"SELECT * FROM homework_topic WHERE `status`='active' AND `id`=$topic_id");
	if(mysqli_num_rows($query)==0){
		$query=mysqli_query($con,"SELECT * FROM homework_topic WHERE `status`='active' AND `id`=3");
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Үй-жұмыстары</title>

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../css/modern-business.css" rel="stylesheet">
	
  <!-- Font Awesome -->
  <link href="admin/font-awesome/css/font-awesome.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <?php require("php-includes/menu.php");?>

  <!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Тізім</h1>

    <!-- <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.html">Home</a>
      </li>
      <li class="breadcrumb-item active">Blog Home 2</li>
    </ol> -->

    <!-- Blog Post -->
	  
	<?php
		$row=mysqli_fetch_array($query);
		$topic_id=$row['id'];
	  	$title=$row['title'];
		$appendix=$row['appendix'];
		$pic="admin/topic_pics/".$row['pic'];
		$doc="admin/topic_docs/".$row['doc'];
		$upload_date=$row['upload_date'];
			
	?>
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6">
            <a href="#">
              <img class="img-fluid rounded" src="<?=$pic?>" alt="">
            </a>
          </div>
          <div class="col-lg-6">
            <h2 class="card-title"><?=$title?></h2>
            <p class="card-text"><?=$appendix?></p>
          </div>
        </div>
      </div>
      <div class="card-footer text-muted">
        Сайтқа шығарылған күні <?=$upload_date?> | <a href="<?=$doc?>">Жүктеу</a>
      </div>
    </div>
	<div class="card mb-4">
       <div class="card-body">
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
							<th>Әрекет</th>
                        </tr>
                	</thead>
                 	<tbody>
						<?php
							$query=mysqli_query($con,"SELECT * FROM homework_task WHERE `status`='active' AND `topic_id`=$topic_id");
				   			if(mysqli_num_rows($query)==0){
								echo "
									<tr>
										<td colspan='4'>Тапсырламар жоқ</td>
									</tr>
								";
							}
							while($row=mysqli_fetch_array($query)){
								$task_id=$row['id'];
								$content=$row['content'];
								$deadline=$row['deadline'];
								$user_task_data=get_user_task_data($task_id,$user_id);
				   				
						?>
                    	<tr>
                        	<td>1</td>
                            <td><?=$content?></td>
                            <td><?=$deadline?></td>
						<?php
							if($user_task_data['status']=='initiated'){
								echo "
									<td>Қарастырылуда</td>
								";
							}
							else if($user_task_data['status']=='approved'){
								echo "
									<td>Қабылданды</td>
								";
							}
							else{
								
						?>
							<td>
								<form role="form" method="post" action="task_request.php?task_id=<?=$task_id?>&topic_id=<?=$topic_id?>" enctype="multipart/form-data">
								  <div class="form-group">
									<input type="file" class="form-control-file" id="exampleFormControlFile1" name="doc">
								  </div>
								  <button type="submit" class="btn btn-primary">Жіберу</button>
								</form>
							</td>
                  		</tr>
						<?php
							}
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

    <!-- Pagination
    <ul class="pagination justify-content-center mb-4">
      <li class="page-item">
        <a class="page-link" href="#">&larr; Older</a>
      </li>
      <li class="page-item disabled">
        <a class="page-link" href="#">Newer &rarr;</a>
      </li>
    </ul>
	 --> 

  </div>

  <!-- </div>
  /.container -->

  <!-- Footer
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
   -->
    <!-- /.container
  </footer>
   -->

  <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
