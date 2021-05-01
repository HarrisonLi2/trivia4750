
<?php 
        require('check_login.php');
        require('connect-db.php');
        session_start();
        if (isset($_POST['gameid'])) {

            $_SESSION["currentGame"]=$_POST['gameid'];
        }
?>

