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
    // PHP Which the Sign-Up Form should execute to submit user information to database.
    require('connect-db.php');
    $username = $pwd = $email = NULL;
    $username_msg = $pwd_msg = NULL;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (!empty($_POST['username']))
            $username = htmlspecialchars($_POST['username']);
        else
            $username_msg = "Please enter your username";

        if (!empty($_POST['pwd']) && !empty($_POST['cpwd'])) {
            if ($_POST['pwd'] !== $_POST['cpwd']) {
                $pwd_msg = "Passwords must match!";
            } else {
                $pwd = htmlspecialchars($_POST['pwd']);
            }
        } else
            $pwd_msg = "Please enter you password";
    }
    $sign_up_failed = false;

    //sign up database query
    if (!empty($_POST['username']) && isset($_POST['pwd']) && isset($_POST['cpwd'])) {
        global $db;
        $query = "SELECT * FROM login WHERE Username=:username";
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        if (isset($results[0])) {
            $username_msg = "Username Already Exists!";
            $sign_up_failed = true;
        } elseif ($_POST['pwd'] == $_POST['cpwd']){
            $query = "INSERT INTO login(Username, Password) VALUES (:username, md5(:pwd))";
            $statement = $db->prepare($query);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':pwd', $pwd);

            $statement->execute();
            $statement->closeCursor();
            setcookie('username', $username, time() + 3600);
            header("Location: login.php?status=success");
			
			$last_id = $db->lastInsertId();
			$query = "INSERT INTO users(user_id) VALUES (:last_id)";
			$statement = $db->prepare($query);
			$statement->bindValue(':last_id', $last_id);
			$statement->execute();
			$statement->closeCursor();
        }
    }
    ?>
    <div class="center">
        <h1 class="welcome"> Welcome To... </h1>
    </div>
    <div class="login center justify-content-between">
        <h4 class="center login_text"> Create Your New Account </h4>

        <form class=action="" method="POST">
            <div class="form-group user_login">
                <label for="username">Username: </label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" value="<?php echo (isset($_POST['username']) && $sign_up_failed==false) ? $_POST['username'] : '' ?>"/>
                <span>
                    <?php if (empty($_POST['username'])) echo "$username_msg <br/>" ?>
                </span>
				<br />
                <label for="pwd">Password:</label>
                <input class="form-control" type="password" name="pwd" id="pwd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required placeholder="Enter Password" />
                <br />
				<span>
                    <?php if (empty($_POST['pwd']) || ($_POST['pwd'] !== $_POST['cpwd'])) echo "$pwd_msg <br/>" ?>
                </span>
                <input type="password" class="form-control" name="cpwd" id="cpwd" placeholder="Confirm Password" required="required">
				<input type="submit" style="margin-bottom:5%; margin-top:5%" value="Sign Up" class="btn btn-secondary"/>
				<span style="padding-bottom:3%">
                    <?php
                    if ($username != NULL) {
						if ($sign_up_failed) echo "<h4 class='center'> Username is already taken! </h4>";
                    }
                    ?>
                </span>
            </div>
            <div class="text-center">Already have an account? <a href="login.php">Sign in</a></div>


    </div>

</body>

</html>