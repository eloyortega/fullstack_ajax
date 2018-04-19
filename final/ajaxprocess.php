<?php
//Store data from my form into variables
$n = $_POST['name'];
$g = $_POST['gender'];

//retrieve the Json file and converted it into php array
$j = file_get_contents('ppl.json');
$j = json_decode($j, true);

//print_r ($j);

$k = "object".$objectCount;

//format the id
$i = count($j);
$i = ++$i;

// insert my variables into an array stored in a variable called $add
$add = array(
	"id" => $i,
	"name" => $n,
	"gender" => $g
);
//print_r ($add);

// append my new array into the json array
array_push($j, $add);
//print_r ($j);

// take my updated json array, format it back into Json and Overwrite it into the Json file
$j = json_encode($j);
file_put_contents('ppl.json', $j);

// Store the image on my service
$t = $_FILES['photo']['tmp_name'];
$f = "img/$i.jpg";
move_uploaded_file( $t, $f);
?>