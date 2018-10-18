<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

/*---------------------------------------------------------*/
function authentication($user, $pass){
$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}

$request = array();
$request['type'] = "login";
$request['user'] = $user;
$request['pass'] = $pass;
$request['message'] = $msg;
$response = $client->send_request($request);

return $response; 

echo $argv[0]." END".PHP_EOL;

} 
$email = $_POST['email'];
$user = $_POST['user'];
$pass = $_POST['pass'];

$response = authentication($user, $pass);

if($response == false){
	echo "\n Login unsuccessful<br>";
	header("Refresh:5; url=login.html");  

}else{
	echo "\n Login Successful<br>"; 
	header("Refresh:5; url=mainpage.html"); 
 
} 

/*---------------------------------------------------------*/
function registration($email,$user,$pass) {
    ( $db = mysqli_connect ( 'localhost', 'root', 'homework321', 'logs' ) );
    if (mysqli_connect_errno())
    {
      echo"\n Failed to connect to MYSQL<br><br> ". mysqli_connect_error();
      exit();
    }
    /*echo "Successfully connected to MySQL\n";*/
    mysqli_select_db($db, 'logs' );
    $e = "SELECT * FROM login WHERE email = '$email'"; 
    $t = mysqli_query($db, $e) or die(mysqli_error($db));
    $r = mysqli_fetch_array($t, MYSQLI_ASSOC);
    $p = $r["email"];
    
    if($email == $p){
        echo " \n Email or User has already been used.  Please try registering again.<br><br>\n";
	return false; 
    }
  
	else{
          mysqli_query($db,"INSERT INTO login (email, user, password) VALUES ('$email', '$user', '$password')");
 
    return true;
}
}

/*---------------------------------------------------------*/


