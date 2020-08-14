<?php
	require("php-includes/check-login.php");
	require("php-includes/connect.php");
	require("php-includes/functions.php");

	$user_id=$_SESSION['userid'];
	$query=mysqli_query($con,"SELECT * FROM homework_user_task WHERE `user_id`=$user_id");
	if(mysqli_num_rows($query)>0){
		$task_count=mysqli_num_rows($query);
	}
	else{
		$task_count=0;
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
    <div class="card mb-4">
       <div class="card-body">
       	<div class="panel-heading">
        	Мен жіберген тапсырмалар: <?=$task_count?>
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
                            <th>Файл</th>
							<th>Жіберілген уақыты</th>
							<th>Статусы</th>
                        </tr>
                	</thead>
                 	<tbody>
						<?php
							if($task_count==0){
								echo "
									<tr>
										<td colspan='7'>Тапсырламар жоқ</td>
									</tr>
								";
							}
							while($row=mysqli_fetch_array($query)){
								$user_task_id=$row['id'];
								$task_id=$row['task_id'];
								$user_id=$row['user_id'];
								$doc="admin/topic_docs/".$row['doc'];	
								$upload_date=$row['upload_date'];	
								$task_status=$row['status'];
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
                        	<td>1</td>
							<td><?=$topic_title?></td>
                            <td><?=$task_content?></td>
                            <td><?=$task_deadline?></td>
							<td><a href="<?=$doc?>">Жүктеу</a></td>
							<td><?=$upload_date?></td>
						<?php
							if($task_status=='initiated'){
								echo "
									<td>Қарастырылуда</td>
								";
							}
							else if($task_status=='approved'){
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
