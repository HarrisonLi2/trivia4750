<?php 
        require('check_login.php');
        require('connect-db.php');
        session_start();
        if (isset($_POST['gameid'])) {

            global $db;

            $query = 'INSERT INTO has_game (user_id, game_id) VALUES (:userid, :gameid)';
             
            $statement = $db->prepare($query);
            $statement->bindValue(':userid', $_SESSION['ID']);
            $statement->bindValue(':gameid', $_POST['gameid']);

            $statement->execute();
        }
?>