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

        <h1>Trivia 4750 Leaderboard</h1>
        <?php
        include("header.php");
        ?>
        <table style="margin-top:20px"id="game_table" class="game_table">
            <thead>
                <tr>
                    <th> User </th>
                    <th> <button class="btn" onclick="sortTable(0)"> Game Name </button> </th>
                    <th> <button class="btn " onclick="sortTable(1)"> Score </button> </th>
                    <th> <button class="btn" onclick="sortTable(2)"> Date </button> </th>
                </tr>
                <?php

                global $db;
                $query = 'SELECT Username, game_name, score, play_date FROM login NATURAL JOIN leaderboard NATURAL JOIN games ORDER BY score DESC';

                $statement = $db->prepare($query);

                $statement->execute();
                $results = $statement->fetchAll();
                foreach ($results as $result) {
                    echo "<tr>";
                    echo '<td>' . $result['Username'] . '</td>';
                    echo "<td>" . $result["game_name"] . "</td>";
                    echo "<td>" . $result["score"] . "</td>";
                    echo "<td>" . $result["play_date"] . "</td>";
                    echo "</tr>";
                }
                ?>
            </thead>

        </table>
    </div>

</body>

</html>