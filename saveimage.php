<?php	

	header("Access-Control-Allow-Origin: *");

	$data = $_POST['image'];
	$id = $_POST['filename'];
	$name = json_encode($_POST['name']);
	$email = json_encode($_POST['email']);
	$myFile = 'bilder/'.$_POST['filename'].'.jpg';
	$myJson = 'json/'.$_POST['filename'].'.js';

	//$json ='{"user":{"name":"'.$name.'", "email":"'.$email.'"}}'
	//file_put_contents($myJson,$json);

	$stringData = '{"user": {"id":'.$id.',"name":'.$name.',"email":'.$email.',"img":"'.$myFile.'"}}';
	file_put_contents($myJson,$stringData);

	$image = $data;
	$image = imagecreatefrompng($image);
	imagejpeg($image, $myFile, 70);
	imagedestroy($image);

?>