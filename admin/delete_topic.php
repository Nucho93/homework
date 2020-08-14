<?php
    session_start();
    require("../php-includes/connect.php");
    require("../php-includes/functions.php");

	$topic_id=mysqli_real_escape_string($con,$_GET['topic_id']);
	mysqli_query($con,"UPDATE homework_topic SET `status`='deleted' WHERE `id`=$topic_id");

	header("Location: all_topics.php");
?>