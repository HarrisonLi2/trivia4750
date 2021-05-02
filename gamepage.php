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

    <div class="col-md-6">
        <form action="./resultsPage.php" method="POST">
            <?php
                
                if (isset($_SESSION['currentGame'])) {
                    global $db;
                    
                    $query = 'SELECT * FROM games WHERE game_id=:gameid';
                        
                    $statement = $db->prepare($query);
                    $statement->bindValue(':gameid', $_SESSION['currentGame']);

                    $statement->execute();
                    $games = $statement->fetchAll();
                    $game = $games[0];
              
                        echo '<h1>Playing: '.$game['game_name'].' Creator: '.$game['creator'].' Difficulty: '.$game['game_rating'].'<h1>';

                        echo '<input type="submit" name="sub" style="margin-bottom:5%; margin-top:5%" value="Submit Game" class="btn btn-primary"/>';

                        $query = 'SELECT * FROM questions NATURAL JOIN game_contains NATURAL JOIN category_contains WHERE game_id=:gameid';
    
                        $statement2 = $db->prepare($query);
                        $statement2->bindValue(':gameid', $_SESSION['currentGame']);
        
                        $statement2->execute();
                        $questions = $statement2->fetchAll();

                        $count = 1;

                        foreach($questions as $question){
                            echo '<h3>Question #'.$count.'</h3>';
                            echo '<h3>'.$question['q_content'].'</h3>';
                            echo '<textarea class="" rows="5" name="'.$question['question_id'].'"  placeholder="Your Answer"></textarea>';
                            $count = $count + 1;
                        }

                        echo '<input type="submit" name="sub" style="margin-bottom:5%; margin-top:5%" value="Submit Game" class="btn btn-primary"/>';
                    
                }
            ?>
        </form>

    </div>

  

</body>
</html>