<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="./css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="./css/style.css" type="text/css" />

<head>
    <title>Trivia!</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

</head>

<body>

    <?php
    session_start();

    // PHP Which the Sign-Up Form should execute to submit user information to database.
    require('connect-db.php');
    $username = $pwd = $email = NULL;
    $username_msg = $pwd_msg = NULL;
    //Setting 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (!empty($_POST['username']))
            $username = htmlspecialchars($_POST['username']);
        else
            $username_msg = "Please enter your username";

        if (!empty($_POST['pwd'])) {
            $pwd = htmlspecialchars($_POST['pwd']);
        } else {
            $pwd_msg = "Please enter you password";
        }
    }
    $loginFailed = false;
    validate($username, $pwd);
    //login database query
    function validate($username, $pwd)
    {
        if (isset($_POST['username']) && isset($_POST['pwd'])) {
            global $db;
            $query = 'SELECT * FROM users WHERE (Username = :username AND Password = :password)';
            $statement = $db->prepare($query);
            $statement->bindValue(':username', $username);
            //logic that enables the user to login without re-inputting password if they somehow end up back at the home page (without explicitly logging out first)
            if(isset($_COOKIE['pwd']))
            {
                $statement->bindValue(':password', $pwd);
            }
            else
            {
                $statement->bindValue(':password', md5($pwd));
            }
            $statement->execute();
            $results = $statement->fetch(PDO::FETCH_ASSOC);
            echo $results;
            $statement->closeCursor();
            if (is_array($results)) {
                echo "results returned";
                $_SESSION["ID"] = $results['user_id'];
                $_SESSION["Username"] = $results['Username'];
                $_SESSION["Email"] = $results['Email'];
                setcookie('username', $username, time() + 3600);
                setcookie('pwd', md5($pwd), time() + 3600);
                header("Location: home.php");
            } else {
                $loginFailed = true;
            }
        }
    }
    ?>
    <div class="center">
        <h1 class="welcome"> Welcome To... </h1>
    </div>
    <div class="login center justify-content-between">
        <h4 class="center login_text"> Sign In To Your Account </h4>
        <form class="" action="" method="POST">
            <div class="form-group user_login">
                <?php if (isset($_GET['status'])) {
                    if ($_GET['status'] == 'success') {
                        echo "<h4 class='center'> Successfully Signed Up! </h4>";
                    }
                } ?>
                <label for="username">Username: </label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" <?php if(isset($_COOKIE['username'])) echo "value='".$_COOKIE['username']."'"?> />
                <br />
                <label for="pwd">Password:</label>
                <input class="form-control" type="password" name="pwd" id="pwd"  title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Enter Password" <?php 
                if(isset($_COOKIE['pwd'])) echo "value='".$_COOKIE['pwd']."'"; 
                else echo 'required'?> />
                <br />
                <input type="submit" style="margin-bottom:1%;width:75%;" value="Login" class="btn btn-secondary" />
                <span style="padding-bottom:1%">
                    <?php
                    if ($loginFailed) echo "<h4 class='center'> Login Failed </h4>";
                    ?>
                </span>
                <br>
                <div style="padding-bottom: 5%;"> No account? <a href="./sign_up.php"> Sign Up </a></div>

            </div>

        </form>



    </div>

</body>

</html>