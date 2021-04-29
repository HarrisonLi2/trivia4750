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

    <div class=" games_menu d-flex">
        <div class="my_community_games col-md-2">
            <li class="menu">
                <ul>
                    <a href="./mygames.php"><button class="btn btn-primary" >My Games</button></a>
                </ul>
                <ul>
                    <a href="./allgames.php"><button class="btn btn-primary" >Browse Games</button> </a>
                </ul>
                <ul>
                    <a href="./profileEdit.php"> <button class="btn btn-primary" >Edit Profile</button></a>
                </ul>
                <ul>
                    <a href="./creation.php"><button class="btn btn-primary" >Create a Game</button></a>
                </ul>
                <ul>
                    <a href="./createCat.php"><button class="btn btn-primary" >Create a Category</button></a>
                </ul>
                <ul>
                    <a href="./createQuestion.php"><button class="btn btn-primary" >Create a Question</button></a>
                </ul>
            </li>
        </div>

        <div>
            <h3>Tutorial:</h1>
            <br>
            <p>Users can create their own games and save other peoples' games. </p>
            <br>
            <p>Games contain categories</p>
            <br>
            <p>Categories contain questions</p>
            <br>
            <p>Questions when answered correctly will award points based on worth</p>
        </div>

    </div>


    <br>
    <div class="creation">
        <span style="float:left;"><button class="btn btn-primary"> <a href="./logout.php" onclick="confirmLogOut()"> Log Out</a> </button></span>
        <span style="float:right;"><button class="btn btn-primary"> <a href="./creation.php"> Create Your Own Game!</a> </button></span>

    </div>

    <script src="js/games.js"> </script>

</body>

</html>