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
  
<div style="padding-top:10%;"class="center">
        <h1 class="welcome"> Logging you out </h1>
        <h2 class="welcome"> Thanks for playing... </h1>

</div>

<?php 

if (count($_COOKIE) > 0)
{
   foreach ($_COOKIE as $key => $value)
   {

      unset($_COOKIE[$key]);   
      setcookie($key, '', time() - 3600);
   }
   header('refresh:5; url=login.php');
}

?>
</body>
</html>