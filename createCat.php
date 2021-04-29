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
                    <a href="./home.php">Back to Home</a>
                </ul>
           
            </li>
        </div>

        <div class="col-md-4">
            <h3>Create a Category</h3>

            <h3>Once you have created some categories return to create a game</h3>
            <span style="float:right;"><button class="btn btn-primary"> <a href="./creation.php"> Return to Create a Game</a> </button></span>
        </div>
   
        <div class="col-md-7">
            <form action="" method="POST">
                <fieldset>
                    <label for="catname">Category Name: </label>
                    <input type="text" class="form-control" name="catname" id="catname" placeholder="Enter Category Name" required/>

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
                            echo '<label>'.$result["q_content"]."</label>";
                            echo '<input type="checkbox" name="checkboxes[]" value="'.$result["question_id"].'"/>';
                        }
                    ?>
                    
                    <input type="submit" name="sub" style="margin-bottom:5%; margin-top:5%" value="Create Category" class="btn btn-secondary"/>
                </fieldset>

            </form>
   
        </div>
    </div>
    <?php
                if (isset($_POST['sub'])) {
                    // collect value of input field

                    global $db;

                    //insert new game
                    $query = 'INSERT INTO categories (cat_name) VALUES ("'.$_POST['catname'].'")';
                    echo '<p>' . $query. '</p>';
                    $statement = $db->prepare($query);

                    $statement->execute();

                    $lastID = $db->lastInsertId();
                
                    //insert selected categories
                    foreach($_POST['checkboxes'] as $checkbox) {
                        $query = 'INSERT INTO category_contains (cat_id, question_id) VALUES ('.$lastID.', '.$checkbox.')';
                        $statement = $db->prepare($query);

                        $statement->execute();
                    }
              }
            ?>

</body>
</html>