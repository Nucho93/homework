<?php
    session_start();
    if(isset($_SESSION['id']) && $_SESSION['login_type']=='user'){
    }
    else{
        echo "
            <script>
                alert('Басынан кір!');
                window.location.assign('index.php');
            </script>
        ";
    }
?>