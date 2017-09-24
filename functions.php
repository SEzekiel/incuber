<?php
session_start();


if (!isset($_GET['name']) && isset($_GET['password'])) {
	$user = $_GET['username'];
	$pass = $_GET['password'];
	login($user,$pass);
}

elseif (isset($_GET['name'])) {
	$user = $_GET['name'];
	$email = $_GET['username'];
	$pass = $_GET['password'];
	signup($user,$email,$pass);
}
elseif (isset($_GET['phone'])) {
	$name = $_GET['uname'];
	$phone = $_GET['phone'];
	$mname = $_GET['mname'];
	notify($name,$phone,$mname);
}
elseif (isset($_GET['i'])) {
	fetch();
}



function login($user,$pass)
{
	
	$query = "SELECT * FROM user WHERE email = '$user' AND password = '$pass'";
	$conn = connect();
	$result = mysqli_query($conn,$query);
	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['name'] = $row['username'];
		echo 1;
	}
	else{
		echo 0;
	}
}

function signup($user,$email,$password)
{
	$id = "";
	$conn = connect();
	$query = "INSERT INTO user(id,username,email,password) VALUES('$id','$user','$email','$password')";

	$result = mysqli_query($conn,$query);
	if ($result) {
		echo 1;
	}
	else{
		echo 0;
	}
}



function notify($name,$phone,$mname)
{
	$id = "";
	$conn = connect();
	$query = "INSERT INTO ubers(id,name,phone,mname) VALUES('$id','$name','$phone','$mname')";

	$result = mysqli_query($conn,$query);
	if ($result) {
		echo 1;
		pushNotification();
	}
	else{
		echo 0;
	}
}

function fetch()
{

	$conn = connect();
	$query = "SELECT * FROM ubers WHERE 1";

	$result = mysqli_query($conn,$query);
	//echo mysqli_num_rows($result);
	if (mysqli_num_rows($result) > 0) {
		 while($row = mysqli_fetch_assoc($result)){
		 $tyme = $row['tyme'];
		 	//$minutes = (int)((time()-strtotime($minutes))/60);
			echo "<div class=\"card card-inverse card-primary mb-3\" style=\"background-color: #0275d8; color: white\"><div class=\"card-block\"><p>Uber driver name: ". $row['name']."</p><p>Phone: ".$row['phone']."</p><p>Posted by: ".$row['mname']."</p><p>Time to arrive: ".$tyme." minutes time</p></div></div>";	
		 }
	}
	else{
		echo "There are no drivers heading for the hill at the moment";
	}
}

function connect()
{
	require('http://incuber.spleint.com/auth.php');
}

function pushNotification(){

// Push The notification with parameters
require_once('PushBots.class.php');
$pb = new PushBots();
// Application ID
$appID = '59c17f184a9efa90928b456a';
// Application Secret
$appSecret = 'f62be525983103d5d23ccc4a539589fc';
$pb->App($appID, $appSecret);
$pb->Platform(array("0","1"));
$pb->Badge("+2");
// Notification Settings
$pb->Alert("Heads up! An Uber is on its way to campus");
$pb->Push();


}
?>
