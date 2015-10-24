<?php
header("Access-Control-Allow-Origin: *");

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "myDB";


    $data = $_POST['image'];
    $id = $_POST['filename'];
    $name = '"'.$_POST['name'].'"';
    $email = '"'.$_POST['email'].'"';
    $myFile = 'bilder/'.$_POST['filename'].'.jpg';
    $myJson = 'json/'.$_POST['filename'].'.js';

    $saveimg = '"'.$_POST['filename'].'.jpg"';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO lop (name, email, image)
VALUES ($name, $email, $saveimg)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

    $image = $data;
    $image = imagecreatefrompng($image);
    imagejpeg($image, $myFile, 70);
    imagedestroy($image);

$conn->close();
?> 