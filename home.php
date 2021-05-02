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


    <div class="games_menu center d-flex">
        <div class="my_community_games col-md-2">
            <ul class="menu">
                <li>
                    <a href="./mygames.php"><button class="btn nav-btn ">My Games</button></a>
                </li>
                <li>
                    <a href="./allgames.php"><button class="btn nav-btn ">Browse Games</button> </a>
                </li>
                <li>
                    <a href="./leaderboard.php"><button class="btn nav-btn ">Leaderboard</button> </a>
                </li>
                <li>
                    <a href="./profileEdit.php"> <button class="btn nav-btn ">Edit Profile</button></a>
                </li>
                <li>
                    <a href="./creation.php"><button class="btn  nav-btn">Create a Game</button></a>
                </li>
                <li>
                    <a href="./createCat.php"><button class="btn  ">Create a Category</button></a>
                </li>
                <li>
                    <a href="./createQuestion.php"><button class="btn  ">Create a Question</button></a>
                </li>

                <li class="">
                    <a href="./logout.php" onclick="confirmLogOut()"> <button class="btn "> Log Out</button></a>
                </li>
            </ul>
        </div>

        <div class="col-md-10">
            <h1 class="h1-black center">Welcome to Trivia4750!</h1>
            <br>
            <h3>Tutorial:</h1>
                <br>
                <p>Users can create their own games and save other peoples' games. </p>
                <br>
                <p>Games contain categories</p>
                <br>
                <p>Categories contain questions</p>
                <br>
                <p>Questions when answered correctly will award points based on worth</p>
                <br>
                <p>Start games from My Games Page</p>
        </div>

    </div>


    <br>




    <script src="js/games.js"> </script>

</body>

</html>