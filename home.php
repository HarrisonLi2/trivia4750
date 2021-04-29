<!DOCTYPE html>

<html lang="en">

<link rel="stylesheet" href="./css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="./css/style.css" type="text/css" />

<head>
    <title>Trivia!</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Jacob Herring (jlh2ag)" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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

    <div class=" games_menu d-flex">
        <div class="my_community_games ">
            <li class="menu">
                <ul>
                    <a href=""> My Games </a>
                </ul>
                <ul>
                    <a href=""> Community Games</a>
                </ul>
                <ul>
                    <a href="./profileEdit.php"> Edit Profile</a>
                </ul>
            </li>
        </div>


        <table id="game_table" class="game_table">
            <thead>
                <tr>
                    <th> <button class="btn btn-primary" onclick="sortTable(0)"> Game Name: </button> </th>
                    <th> <button class="btn btn-primary" onclick="sortTable(1)"> Game Rating: </button> </th>
                    <th> <button class="btn btn-primary" onclick="sortTable(2)"> Created By: </button> </th>

                    <div class="table_info_extra">
                        <th class="priority-1"> Category One: </th>
                        <th class="priority-2"> Category Two: </th>
                        <th class="priority-3"> Category Three: </th>
                        <th class="priority-4"> Category Four: </th>
                        <th class="priority-5"> Category Five: </th>
                        <th class="priority-6"> Category Six: </th>
                    </div>

                </tr>
                <?php

                    global $db;
                    $query = 'SELECT * FROM games';
                    $statement = $db->prepare($query);

                    $statement->execute();
                    $results = $statement->fetchAll();
                    foreach ($results as $result) {
                        echo "<tr>";
                        echo "<td>" . $result["game_name"] . "</td>";
                        echo "<td>" . $result["game_rating"] . "</td>";
                        echo "<td>" . $result["creator"] . "</td>";
                        echo "<td class='priority-1'>" . json_decode($result["cat1"],true)['category_name'] . "</td>";
                        echo "<td class='priority-2'>" . json_decode($result["cat2"],true)['category_name'] . "</td>";
                        echo "<td class='priority-3'>" . json_decode($result["cat3"],true)['category_name'] . "</td>";
                        echo "<td class='priority-4'>" . json_decode($result["cat4"],true)['category_name'] . "</td>";
                        echo "<td class='priority-5'>" . json_decode($result["cat5"],true)['category_name'] . "</td>";
                        echo "<td class='priority-6'>" . json_decode($result["cat6"],true)['category_name'] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </thead>

            <?php



            ?>

        </table>
    </div>
    <br>
    <div class="creation">
        <span style="float:left;"><button class="btn btn-primary"> <a href="./logout.php" onclick="confirmLogOut()"> Log Out</a> </button></span>
        <span style="float:right;"><button class="btn btn-primary"> <a href="./creation.php"> Create Your Own Game!</a> </button></span>

    </div>

    <script src="js/games.js"> </script>

</body>

</html>