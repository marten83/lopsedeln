
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "myDB";
$image=$_GET['image'];

$getRow = '"'.$image.'.jpg"';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysql_query( "SET NAMES utf8");
mysql_query( "SET CHARACTER SET utf8"); 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, email, image FROM Lop where image = $getRow";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$name = $row["name"];
$email = $row["email"];


?>
<?php header('Content-type: text/plain; charset=utf-8'); ?>
<!doctype html>
<html lang="sv">
<head>
  <meta charset="utf-8">

  <title>Mitt NA-Löp</title>
  <meta name="description" content="Mitt NA-Löp">
  <meta name="author" content="NA.se">


    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

  <!-- for Facebook -->          
	<meta property="og:title" content="Mitt NA-Löp" />
	<meta property="og:type" content="article" />
	<meta property="og:image" content="http://duadmin.azurewebsites.net/test/lop/bilder/<?php echo $image?>.jpg" />
	<meta property="og:url" content="http://duadmin.azurewebsites.net/test/lop/page.php?image=<?php echo $image?>" />
	<meta property="og:description" content="Skapa din egen löpsedel på na.se" />
<style>
img {
    height: auto;
    max-width: 500px;
    width: 100%;
}
</style>
</head>
<body>
<h1>Mitt NA-Löp</h1>
<?php
		echo '<div>'.$name.'</div>';
		echo '<div>'.$email.'</div>';

		$jsonfile = json_decode(file_get_contents('json/'.$image.'.js'));
		foreach($jsonfile as $key => $value) {
			print '<p>skapad av: '.$value->name.'<p>';
			print '<p>'.$value->email.'<p>';
		}
?>
<img src="bilder/<?php echo $image?>.jpg"/>
</body>
</html>