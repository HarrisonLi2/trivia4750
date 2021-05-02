<?php
    require('check_login.php');
    require('connect-db.php');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['download_game'])) {
                $query = "SELECT * FROM games WHERE game_id=:id";
                $statement = $db->prepare($query);
                $statement->bindValue(':id', $_POST['download_game']);
                $statement->execute();
                $results = $statement->fetchAll();
                $data = json_encode($results);
                header('Content-Type: application/json');
                header('Content-Disposition: attachment; filename=data.json');
                header('Expires: 0'); //No caching allowed
                header('Cache-Control: must-revalidate');
                header('Content-Length: ' . strlen($data));
                file_put_contents('php://output', $data);
            }
        }
?>