<?php
// hostname
$hostname = 'usersrv01.cs.virginia.edu:3306';

// database name
$dbname = 'rml8daw_trivia';

// database credentials
$username = 'rml8daw';
$password = 'Warren4pre$2020';


$dsn = "mysql:host=$hostname;dbname=$dbname";

/** connect to the database **/
try 
{
//  $db = new PDO("mysql:host=$hostname;dbname=$dbname, $username, $password);
   $db = new PDO($dsn, $username, $password);
   
   // dispaly a message to let us know that we are connected to the database 
}
catch (PDOException $e)     // handle a PDO exception (errors thrown by the PDO library)
{

   $error_message = $e->getMessage();        
   echo "<p>An error occurred while connecting to the database: $error_message </p>";
}
catch (Exception $e)       // handle any type of exception
{
   $error_message = $e->getMessage();
   echo "<p>Error message: $error_message </p>";
}

?>



