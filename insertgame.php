<?php 
        require('check_login.php');
        require('connect-db.php');
        session_start();
        if (isset($_POST['gameid'])) {

            global $db;

            $query = 'INSERT INTO has_game (user_id, game_id) VALUES ('.$_SESSION['ID'].', '. $_POST['gameid'].')';
             
            $statement = $db->prepare($query);

            $statement->execute();
        }
?>