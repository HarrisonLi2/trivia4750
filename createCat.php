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

<h1 class="center">Create a Category</h1>
        <?php
        include("header.php");
        ?>
    <div style="padding-top:20px" class=" games_menu d-flex">

        <div class="col-md-4">
           

            <h3 style="color:black">Once you have created some categories go create a game</h3>
            <button class="btn "> <a href="./creation.php">Create a Game</a> </button>
            <br>

            <h5 style="color:black">Create More Questions</h5>
            <button class="btn "> <a href="./createQuestion.php"> Create a Question</a> </button>
        </div>
   
        <div class="col-md-8">

            <form action="" method="POST">
                <fieldset>
                    <label for="catname">Category Name: </label>
                    <input type="text" class="form-control" name="catname" id="catname" placeholder="Enter Category Name" required/>

                    <label for="checkboxes[]">Available Questions: </label>
                    <?php
                        global $db;
                        $query = 'SELECT * FROM questions';
                        $statement = $db->prepare($query);

                        $statement->execute();
                        $results = $statement->fetchAll();

                        if(empty($results)){
                            echo '<h3 style="color:black">No questions. Create some!</h3>';
                            echo '<button class="btn btn-light"> <a href="./createQuestion.php">Create Question</a> </button>';
                        }
                        foreach ($results as $result) {
                            echo '<span>';
                            echo '<label>Question: '.$result["q_content"]."</label>";
                            echo '<input type="checkbox" name="checkboxes[]" value="'.$result["question_id"].'"/>';
                            echo '</span>';

                        }
                    ?>
                    <input type="submit" name="sub" style="margin-bottom:5%; margin-top:5%" value="Create Category" class="btn"/>
                </fieldset>

            </form>
   
        </div>
    </div>
    <?php
                if (isset($_POST['sub'])) {
                    // collect value of input field

                    global $db;

                    //insert new game
                    $query = 'INSERT INTO categories (cat_name) VALUES (:catname)';
                    $statement = $db->prepare($query);
                    $statement->bindValue(':catname', $_POST['catname']);
                    $statement->execute();

                    $lastID = $db->lastInsertId();
                
                    //insert selected categories
                    foreach($_POST['checkboxes'] as $checkbox) {
                        $query = 'INSERT INTO category_contains (cat_id, question_id) VALUES (:qid, :cbox)';
                        $statement = $db->prepare($query);
                        $statement->bindValue(':qid', $lastID);
                        $statement->bindValue(':cbox', $checkbox);
                        $statement->execute();
                    }

                    echo "<script>alert('Category: ".$_POST['catname']." successfully created. Click ok to continue.');</script>";
              }
            ?>

</body>
</html>