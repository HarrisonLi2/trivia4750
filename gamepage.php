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
    if (isset($_SESSION['currentGame'])) {
        global $db;

        $query = 'SELECT * FROM games WHERE game_id=:gameid';

        $statement = $db->prepare($query);
        $statement->bindValue(':gameid', $_SESSION['currentGame']);

        $statement->execute();
        $games = $statement->fetchAll();
        $game = $games[0];
    }

    ?>
    

    <h1 class="center"> <?php global $game; echo "Playing:".$game['game_name'] ?> </h1>
    <h4 class="center"> <?php global $game; echo "By: ". $game['creator'] ?> </h1>
    <h4 class="center"> <?php global $game; echo "Rating: ". $game['game_rating']?> </h1>

    <?php

    
    include("header.php");
    ?>


    <div style="width:600px; margin-left:auto;margin-right:auto"class="col-md-12">
        <form action="./resultsPage.php" method="POST">
            <?php

            if (isset($_SESSION['currentGame'])) {

                echo '<input type="submit" name="sub" style="margin-bottom:5%; margin-top:5%" value="Submit Game" class="btn btn-light"/>';

                $query = 'SELECT * FROM questions NATURAL JOIN game_contains NATURAL JOIN category_contains WHERE game_id=:gameid';

                $statement2 = $db->prepare($query);
                $statement2->bindValue(':gameid', $_SESSION['currentGame']);

                $statement2->execute();
                $questions = $statement2->fetchAll();

                $count = 1;

                foreach ($questions as $question) {
                    echo '<h3 class="center">Question #' . $count . '</h3>';
                    echo '<h3 class="center">' . $question['q_content'] . '</h3>';
                    echo '<input style="font-size:3em;"class="" rows="5" name="' . $question['question_id'] . '"  placeholder="Your Answer">';
                    $count = $count + 1;
                }

                echo '<input type="submit" name="sub" style="margin-bottom:5%; margin-top:5%" value="Submit Game" class="btn btn-light"/>';
            }
            ?>
        </form>

    </div>



</body>

</html>