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
    <h1 class="center">Game Results:</h1>

    <?php
    include("header.php");
    ?>

    <div class="center" style="margin-top: 20px;width: 600px; margin-left:auto;margin-right:auto;">
        <?php
        //check number of questions correct 
        //total up score
        //insert game into leaderboard 
        //return to mygames
        if (isset($_POST['sub'])) {

            global $db;

            $query = 'SELECT question_id, q_content, answer, worth FROM questions NATURAL JOIN game_contains NATURAL JOIN category_contains NATURAL JOIN questions_answer WHERE game_id=:gameid';

            $statement = $db->prepare($query);
            $statement->bindValue(':gameid', $_SESSION['currentGame']);
            $statement->execute();
            $QAS = $statement->fetchAll();

            $score = 0;
            $totpts = 0;
            $wrongpts = 0;

            foreach ($QAS as $QA) {
                echo '<h3>Question: ' . $QA['q_content'] . ' (' . $QA['worth'] . ' points)</h3>';
                echo '<h3>Your Answer: ' . $_POST[strval($QA['question_id'])] . '</h3>';
                echo '<h3>Correct Answer:' . $QA['answer'] . '</h3>';

                if (strcasecmp(trim($_POST[strval($QA['question_id'])], " \n\r\t\v\0"), trim($QA['answer'], " \n\r\t\v\0")) == 0) {
                    $score = $score + $QA['worth'];
                } else {
                    $wrongpts = $wrongpts + $QA['worth'];
                }
                $totpts = $totpts + $QA['worth'];
            }

            $percent = round($score / $totpts * 100, 2);

            //add game to leaderboard

            $query = 'INSERT INTO leaderboard (user_id, game_id, score) VALUES (:userid, :gameid, :score)';

            $statement = $db->prepare($query);
            $statement->bindValue(':userid', $_SESSION['ID']);
            $statement->bindValue(':gameid', $_SESSION['currentGame']);
            $statement->bindValue(':score', $percent);
            $statement->execute();

            $query = 'UPDATE users SET points = points + ' . $score . ' - ' . $wrongpts . ' WHERE user_id = ' . $_SESSION['ID'];
            $statement = $db->prepare($query);
            $statement->execute();


            echo '<h3>Your Score: ' . $score . '/' . $totpts . ' (' . $percent . '%) Thanks for playing!</h3>';
        }
        ?>
    </div>


</body>

</html>