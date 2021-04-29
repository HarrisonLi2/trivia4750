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
                     <a href="./home.php"><button class="btn btn-primary" >Back to Home</button></a>
                </ul>
           
            </li>
    </div>

    <div>
        <h1>Your Games</h1>
        <table id="game_table" class="game_table">
                <thead>
                    <tr>
                        <th> - </th>
                        <th> <button class="btn btn-primary" onclick="sortTable(0)"> Game Name: </button> </th>
                        <th> <button class="btn btn-primary" onclick="sortTable(1)"> Game Difficulty: </button> </th>
                        <th> <button class="btn btn-primary" onclick="sortTable(2)"> Created By: </button> </th>
                      
                    </tr>
                    <?php

                        global $db;
                        $query = 'SELECT * FROM games WHERE game_id IN (SELECT game_id FROM has_game WHERE user_id='.$_SESSION['ID'].')';
                
                        $statement = $db->prepare($query);

                        $statement->execute();
                        $results = $statement->fetchAll();
                        foreach ($results as $result) {
                            echo "<tr>";
                            echo '<td><button class="btn btn-primary" onclick="sortTable(0)"> Play </button></td>';
                            echo "<td>" . $result["game_name"] . "</td>";
                            echo "<td>" . $result["game_rating"] . "</td>";
                            echo "<td>" . $result["creator"] . "</td>";
                    
                            echo "</tr>";
                        }
                    ?>
                </thead>
        </table>
    </div>


</body>
</html>