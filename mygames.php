
<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="./css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="./css/style.css" type="text/css" />

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    require('check_login.php');
    require('connect-db.php');
    session_start();
    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['delete_game'])) {
            $query = "DELETE FROM games WHERE game_id=:id";
            $statement = $db->prepare($query);
            $statement->bindValue(':id', $_POST['delete_game']);
            $statement->execute();
        }
    }
    ?>
    <div>


        <h1 class="center">Your Games</h1>

        <?php
        include("header.php");
        ?>
        <div style="margin-top:20px" class="games_menu">
            <table id="game_table" class="game_table">
            <thead>

                
                
                <?php

                global $db;
                $query = 'SELECT * FROM games WHERE game_id IN (SELECT game_id FROM has_game WHERE user_id=:userid)';
                $statement = $db->prepare($query);
                $statement->bindValue(':userid', $_SESSION['ID']);

                $statement->execute();
                $results = $statement->fetchAll();
                if (empty($results)) {
                    echo "<h3 class='center' style='color:black'>No games found. Add or Create a Game!</h3>";
                }
                else{
                    echo 
                    '<tr>
                    <th>  </th>
                    <th> <button class="btn " onclick="sortTable(1)"> Game Name: </button> </th>
                    <th> <button class="btn " onclick="sortTable(2)"> Game Difficulty: </button> </th>
                    <th> <button class="btn " onclick="sortTable(3)"> Created By: </button> </th>
                    <th> Remove? </th>
                    <th> Delete Permanently </th>
                </tr>';
                }
                foreach ($results as $result) {
                    echo "<tr>";
                    echo '<td><button class="playbutton btn btn-light" name="' . $result['game_id'] . '" value="' . $result['game_id'] . '"> Play </button></td>';
                    echo "<td>" . $result["game_name"] . "</td>";
                    echo "<td>" . $result["game_rating"] . "</td>";
                    echo "<td>" . $result["creator"] . "</td>";
                    echo '<td><button class="removebutton btn btn-danger" name="' . $result['game_id'] . '" value="' . $result['game_id'] . '"> Remove </button></td>';

                    if ($result['creator'] == $_SESSION['Username']) {
                        echo '<td>
                                        <form action="" method="POST">
                                        <input type="text" hidden name="delete_game" id="delete_game" value="' . $result['game_id'] . '">
                                        <input type="submit" class="removebutton btn btn-danger" id="' . $result['game_id'] . '" value="Delete"> 
                                        </form>
                                      </td>';
                    } else {
                        echo '<td> Not Your Game! </td>';
                    }

                    echo "</tr>";
                }

                ?>
            </thead>
        </table>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./js/playGame.js"></script>
    <script src="./js/removeGame.js"></script>
</body>

</html>
