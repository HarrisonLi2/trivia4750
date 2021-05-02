<?php 
        require('check_login.php');
        require('connect-db.php');
        session_start();
        if (isset($_POST['gameid'])) {

            global $db;

            $query = 'DELETE FROM has_game WHERE user_id=:userid AND game_id=:gameid';
             
            $statement = $db->prepare($query);
            $statement->bindValue(':userid', $_SESSION['ID']);
            $statement->bindValue(':gameid', $_POST['gameid']);

            $statement->execute();
        }
?>