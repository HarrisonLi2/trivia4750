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
                <h3>Edit Profile</h3>
            </div>
    
            <div>
                <form action="" method="POST">
                    <fieldset>
                        <?php
                            global $db;
                            $query = 'SELECT * FROM users WHERE user_id=:userid';
                            $statement = $db->prepare($query);
                            $statement->bindValue(':userid', $_SESSION['ID']);
                            $statement->execute();
                            $results = $statement->fetchAll();
                            foreach ($results as $result) {

                                echo '<label for="firstname">First Name: </label>';
                                echo '<input type="text" class="form-control" name="firstname" id="firstname" value="'.$result["first_name"].'" required/>';

                                echo '<label for="firstname">Last Name: </label>';
                                echo '<input type="text" class="form-control" name="lastname" id="lastname" value="'.$result['last_name'].'" required/>';

                                echo '<label for="firstname">User Name: </label>';
                                echo '<input type="text" class="form-control" name="username" id="username" value="'.$_SESSION['Username'].'" required/>';

                                echo '<label for="firstname">Email: </label>';
                                echo '<input type="text" class="form-control" name="email" id="email" value="'.$_SESSION['Email'].'" required/>';

                            }
        
                        ?>
                        
                        <input type="submit" name="sub" style="margin-bottom:5%; margin-top:5%" value="Update Profile" class="btn btn-primary"/>
                    </fieldset>

                </form>


    
            </div>

        </div>

        <?php
            if (isset($_POST['sub'])) {
                // collect value of input field

                global $db;

                //update user table
                $query = 'UPDATE users SET first_name=:firstname, last_name=:lastname WHERE user_id=:userid';
             
                $statement = $db->prepare($query);
                $statement->bindValue(':firstname', $_POST['firstname']);
                $statement->bindValue('lastname', $_POST['lastname']);
                $statement->bindValue(':userid', $_SESSION['ID']);
                $statement->execute();
                
                //update login table

                $query = 'UPDATE login SET Username=:username, Email=:email WHERE user_id='.$_SESSION['ID'].'';
                $statement = $db->prepare($query);
                $statement->bindValue(':username', $_POST['username']);
                $statement->bindValue(':email', $_POST['email']);
                $statement->bindValue(':userid', $_SESSION['ID']);
                $statement->execute();
                
                $_COOKIE['username']=$_POST['username'];
                $_SESSION['Username']=$_POST['username'];
                $_SESSION['Email']=$_POST['email'];

                echo "<script>alert('Profile successfully updated. Click ok to continue.');</script>";
            }
        ?>

    </body>
</html>