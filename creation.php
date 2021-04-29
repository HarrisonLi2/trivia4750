<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="./css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="./css/style.css" type="text/css" />

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia!</title>
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
                    <a href="./home.php"><button class="btn btn-primary" >Back to Home</button></a>
                </ul>
           
            </li>
        </div>

        <div class="col-md-4">
            <h3>Make Game</h3>

            <h3>Games require categories: create a category</h3>
            <span style="float:right;"><button class="btn btn-primary"> <a href="./createCat.php"> Create a Category</a> </button></span>
        </div>
   
        <div>
            <form action="" method="POST">
                <fieldset>
                    <label for="gamename">Game name: </label>
                    <input type="text" class="form-control" name="gamename" id="gamename" placeholder="Enter Game Name" required/>

                    <label for="rating">Difficulty (Easiest 1 - 10 Hardest): </label>
                    <input type="number" class="form-control" name="rating" id="rating" placeholder="Enter Game Difficulty" min="1" max="10" required/>

                    <label for="checkboxes[]"> Select Categories: </label>

                    <?php
                        global $db;
                        $query = 'SELECT * FROM categories';
                        $statement = $db->prepare($query);

                        $statement->execute();
                        $results = $statement->fetchAll();
                        foreach ($results as $result) {
                            echo '<label>'.$result["cat_name"]."</label>";
                            echo '<input type="checkbox" name="checkboxes[]" value="'.$result["cat_id"].'"/>';
                        }
                    ?>
                    
                    <input type="submit" name="sub" style="margin-bottom:5%; margin-top:5%" value="Create Game" class="btn btn-secondary"/>
                </fieldset>

            </form>
        </div>
    
    </div>

    <?php
                if (isset($_POST['sub'])) {
                    // collect value of input field
    
                    global $db;

                    //insert new game
                    $query = 'INSERT INTO games (game_name, game_rating, creator) VALUES ("'.$_POST['gamename'].'", '.(int)$_POST['rating'].', "'.$_SESSION['Username'].'")';
            
                    $statement = $db->prepare($query);

                    $statement->execute();
                    
                    $lastID = $db->lastInsertId();

                    //insert selected categories
                    foreach($_POST['checkboxes'] as $checkbox) {
                        $query = 'INSERT INTO game_contains (game_id, cat_id) VALUES ('.$lastID.', '.$checkbox.')';
                        $statement = $db->prepare($query);

                        $statement->execute();
                    }

                    //add new game to user's game list
                    $query = 'INSERT INTO has_game (user_id, game_id) VALUES ('.$_SESSION['ID'].', '.$lastID.')';
            
                    $statement = $db->prepare($query);

                    $statement->execute();

                }
    ?>

</body>
</html>