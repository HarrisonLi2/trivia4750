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

    <div>
        <p> Logged in as <?php echo $_SESSION['Username'] ?> </p>

    </div>
    <div class="">
        <li class="menu">
            <ul>
                <a href="./home.php"><button class="btn btn-primary">Back to Home</button></a>
            </ul>
        </li>
    </div>

    <div>

        



        <a href="./mygames.php"><button class="btn btn-primary">Your Games</button></a>

        <a href="./creation.php"><button class="btn btn-primary">Create Game</button></a>

        <h1>All Games</h1>
        <table id="game_table" class="game_table">
            <thead>
                <tr>
                    <th> - </th>
                    <th> <button class="btn btn-primary" onclick="sortTable(1)"> Game Name: </button> </th>
                    <th> <button class="btn btn-primary" onclick="sortTable(2)"> Game Difficulty: </button> </th>
                    <th> <button class="btn btn-primary" onclick="sortTable(3)"> Created By: </button> </th>
                    <th> Export JSON </th>
                </tr>
                <?php
                global $db;
                $query = 'SELECT * FROM games';

                $statement = $db->prepare($query);

                $statement->execute();
                $results = $statement->fetchAll();
                foreach ($results as $result) {
                    echo "<tr>";
                    echo '<td><button class="addbutton btn btn-primary" name="' . $result['game_id'] . '" value="' . $result['game_id'] . '"> + </button></td>';
                    echo "<td>" . $result["game_name"] . "</td>";
                    echo "<td>" . $result["game_rating"] . "</td>";
                    echo "<td>" . $result["creator"] . "</td>";
                    echo '<td>
                                <form action="download.php" method="POST">
                                <input type="text" hidden name="download_game" id="download_game" value="' . $result['game_id'] . '">
                                <input type="submit" class="btn" id="' . $result['game_id'] . '" value="Export"> 
                                </form>
                        </td>';
                    echo "</tr>";
                }
                ?>
            </thead>

        </table>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./js/addGame.js"></script>
    <script src="./js/games.js"></script>

</body>

</html>