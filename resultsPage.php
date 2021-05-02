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

    <div class="">
            <li class="menu">
                <ul>
                     <a href="./home.php"><button class="btn btn-primary" >Back to Home</button></a>
                </ul>
           
            </li>
    </div>

    <div class="">
        <h1>Game Results:</h1>

    </div>

    <?php       
                //check number of questions correct 
                //total up score
                //insert game into leaderboard 
                //return to mygames
                if (isset($_POST['sub'])) {

                    global $db;

                    $query = 'SELECT question_id, q_content, answer, worth FROM questions NATURAL JOIN game_contains NATURAL JOIN category_contains NATURAL JOIN questions_answer WHERE game_id='.$_SESSION['currentGame'].'';
                    
                    $statement = $db->prepare($query);
    
                    $statement->execute();
                    $QAS = $statement->fetchAll();

                    $score = 0;
                    $totpts = 0;

                    foreach($QAS as $QA){
                        echo '<h3>Question: '.$QA['q_content'].' ('.$QA['worth'].' points)</h3>';
                        echo '<h3>Your Answer: '.$_POST[strval($QA['question_id'])].'</h3>';
                        echo '<h3>Correct Answer:'.$QA['answer'].'</h3>';
                        
                        if(strcasecmp($_POST[strval($QA['question_id'])], $QA['answer'])==0){
                            $score = $score + $QA['worth'];
                        }
                        $totpts = $totpts + $QA['worth'];
                    }

                    $percent = round($score / $totpts * 100, 2);

                    //add game to leaderboard

                    $query = 'INSERT INTO leaderboard (user_id, game_id, score) VALUES ('.$_SESSION['ID'].', '.$_SESSION['currentGame'].', '.$percent.')';
    
                    $statement = $db->prepare($query);
    
                    $statement->execute();


                    

                   echo '<h3>Your Score: '.$score.'/'.$totpts.' ('.$percent.'%) Thanks for playing!</h3>';
              }
    ?>

</body>

</html>