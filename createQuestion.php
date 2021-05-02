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
          <h1 class="center">Create a Question</h1>
<?php 
        include("header.php");
    ?>
    <div class=" games_menu d-flex">
        <div class="col-md-3">
            <h3>Once you have created some questions add questions to a category</h3>
            <button class="btn btn-light"> <a href="./createCat.php"> Create a Category</a> </button>
        </div>
        <div class="col-md-9">
            <form action="" method="POST">
                <fieldset>
                    <label for="question">Question Input: </label>
                    <textarea class="form-control" maxlength="255" rows="5" name="question" id="question" placeholder="Enter Question" required></textarea>

                    <label for="answer">Correct Answer: </label>
                    <textarea class="form-control" rows="5" name="answer" id="answer" placeholder="Answer to Question" required></textarea>
                   
                    <label for="rating">Question Difficulty (Easiest 1 - 10 Hardest): </label>
                    <input type="number" class="form-control" name="rating" id="rating" placeholder="Enter Question Difficulty" min="1" max="10" required/>

                    <label for="worth">Question Worth (1-100): </label>
                    <input type="number" class="form-control" name="worth" id="worth" placeholder="Enter Question Worth" min="1" max="100" required/>

                    <input type="submit" name="sub" style="margin-bottom:5%; margin-top:5%;" value="Create Question" class="btn btn-light"/>
                </fieldset>

            </form>
   
        </div>
    </div>
    <?php
                if (isset($_POST['sub'])) {
                    // collect value of input field

                    global $db;

                    //insert new question
                    $query = 'INSERT INTO questions (q_content, difficulty, worth) VALUES ("'.$_POST['question'].'", '. $_POST['rating'].', '.$_POST['worth'].')';
             
                    $statement = $db->prepare($query);

                    $statement->execute();
                
                    $lastID = $db->lastInsertId();

                   //register answer
                   $query = 'INSERT INTO questions_answer (question_id, answer) VALUES ('.$lastID.', "'. $_POST['answer'].'")';
        
                   $statement = $db->prepare($query);

                   $statement->execute();
                    
                   echo "<script>alert('Question:".$_POST['question']." successfully created. Click ok to continue.');</script>";
              }
    ?>

</body>
</html>