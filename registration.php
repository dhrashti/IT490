<?php
ini_set("display_errors", 1);
ini_set("log_errors",1);
ini_set("error_log", "/tmp/error.log");
error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT);
error_log("Hello, errors!");

include ('Client.php');

$email = $_POST['email'];
$user = $_POST['user'];
$pass = $_POST['pass']; 
$response = registration($email,$user,$pass);


if($response != true)
  {
    echo "\n Registration Failed. Please try a different email";
    header( "Refresh:5; url=registration.html", true, 303);
  }
  else
  {
    echo "\n Thank you for Registering!";
    header( "Refresh:5; url=login.html", true, 303);
  }
?>
