<?php
$files = glob('json/*.{js}', GLOB_BRACE);
$moderate=$_GET['moderate'];
$id=$_GET['id'];
/*Checks if value exsists*/
function search_array($needle, $haystack) {
	if(in_array($needle, $haystack)) {
		return true;
	}
	foreach($haystack as $element) {
		if(is_array($element) && search_array($needle, $element))
		return true;
	}
	return false;
}
/*end Checks if value exsists*/
if($moderate=='yes'){
		$getfile = file_get_contents('master.js');
		$decodejson = json_decode($getfile, true);

		foreach ($decodejson['users'] as $i => $item ){
			if ($item['id'] == $id){
				$decodejson['users'][$i]['moderated']='yes';
			}
		}
		$myFile = 'master.js'; //URL To File
		$stringData = json_encode($decodejson);
		print 'done';
		file_put_contents($myFile,$stringData);
}
else if($moderate=='no'){
		$getfile = file_get_contents('master.js');
		$decodejson = json_decode($getfile, true);

		foreach ($decodejson['users'] as $i => $item ){
			if ($item['id'] == $id){
				$decodejson['users'][$i]['moderated']='no';
			}
		}
		$myFile = 'master.js'; //URL To File
		$stringData = json_encode($decodejson);
		print 'done';
		file_put_contents($myFile,$stringData);
}
else{
	foreach($files as $file) {
		$jsonfile = json_decode(file_get_contents($file));
		foreach($jsonfile as $key => $value) {

			if(file_exists('master.js')){
				$getfile = file_get_contents('master.js');
				$decodejson = json_decode($getfile, true);

				if(!search_array($value->id, $decodejson)) {
					array_push($decodejson['users'], array('id' => ''.$value->id.'', 'name' => ''.$value->name.'', 'email' => ''.$value->email.'', 'img' => ''.$value->img.'', 'moderated' => 'no'));
				}

				$myFile = 'master.js'; //URL To File
				$stringData = json_encode($decodejson);
				print 'done';
				file_put_contents($myFile,$stringData);
			
			}
			else{
				$decodejson = array();	
				$decodejson['id'] = ''.$value->id.'';
				$decodejson['name'] = ''.$value->name.'';
				$decodejson['email'] = ''.$value->email.'';
				$decodejson['img'] = ''.$value->img.'';
				$decodejson['moderated'] = 'no';
				
				$data[] = $decodejson;
			
				$myFile = 'master.js'; //URL To File
				$stringData = '{"users":'.json_encode($data).'}';
				print_r($stringData);
				print 'done';
				file_put_contents($myFile,$stringData);
				
			}
		}
	}
}
//print json_encode($data);
?>