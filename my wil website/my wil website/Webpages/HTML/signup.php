<?php
$username = $_POST['username'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber']
$password  = $_POST['password'];

//database connection

$conn = new mysqli('localhost','root','Example@2024#','Users');
if  ($conn->connect_error) {
    die('Connections Failed : '.$conn->connect_error);
}else{
    $stmt = $conn->prepare("insert into registration(username, email,  phonenumber, password) values(?,?,?,?)");
    $stmt->bind_param("ssss",$username,$email,$password,$phonenumber);
    $stmt->execute();
    echo "registration  successful";
    $stmt->close();
    $conn->close();



}





?>