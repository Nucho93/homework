<?php
	$db_host='srv-pleskdb25.ps.kz:3306';
	$db_user='nucho_improve';
	$db_pass='10d3Vj_i';
	$db_name='nuchokz_improve';

	$con=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
    if(mysqli_connect_error()){
        echo "Connect to database failed!";
    }
?>