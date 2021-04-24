<?php
if(!isset($_COOKIE['username']))  
{
    echo "NOT SET";
    header("Location: login.php");
}
?>