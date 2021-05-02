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
           

            <h3>Once you have created some categories go create a game</h3>
            <button class="btn btn-primary"> <a href="./creation.php">Create a Game</a> </button>
            <br>

            <h5>Create More Questions</h5>
            <button class="btn btn-primary"> <a href="./createQuestion.php"> Create a Question</a> </button>
        </div>
   
        <div class="col-md-7">
             <h3>Create a Category</h3>
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
                            echo '<h3>No questions. Create some!</h3>';
                            echo '<button class="btn btn-primary"> <a href="./createQuestion.php">Create Question</a> </button>';
                        }
                        foreach ($results as $result) {
                            echo '<label>Question: '.$result["q_content"]."</label>";
                            echo '<input type="checkbox" name="checkboxes[]" value="'.$result["question_id"].'"/>';
                        }
                    ?>
                    
                    <input type="submit" name="sub" style="margin-bottom:5%; margin-top:5%" value="Create Category" class="btn btn-primary"/>
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