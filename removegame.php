<?php 
        require('check_login.php');
        require('connect-db.php');
        session_start();
        if (isset($_POST['gameid'])) {

            global $db;

            $query = 'DELETE FROM has_game WHERE user_id='.$_SESSION['ID'].' AND game_id='. $_POST['gameid'].'';
             
            $statement = $db->prepare($query);

            $statement->execute();
        }
?>