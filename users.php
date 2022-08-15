<?php
ob_start();
session_start();
header('location:signup.php');

$data = array(
    'name' => strtolower($_POST["username"]),
    'pass' => $_POST["password"],
);

$str = file_get_contents('users.json');
$json = json_decode($str, true);

for ($i=0; $i <= count($json[users][name]) ; $i++) { 
    if($json[users][$i][name] === strtolower($_POST["username"])){
        $_SESSION['unique'] = '<span class="alert column-md-6 column-xs-10">This username has already been taken by another user :(</span>';
    }
    else {
        $_SESSION['created'] = '<span class="alert success-alert column-md-6 column-xs-10">Your account successfully created :D <a href="index.php">Login</a></span>';
        $json[users][] = $data ;
        $jsonData = json_encode($json);
        file_put_contents('users.json', $jsonData);  
    }
}
?>