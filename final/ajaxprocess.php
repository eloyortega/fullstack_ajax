<?php
//Store data from my form into variables
$n = $_POST['name'];
$g = $_POST['gender'];

//retrieve the Jason file and converted it into php array
$jr = file_get_contents('ppl.json');
$j = json_decode($jr, true);

//echo "<br>temp array <hr>";
//print_r ($j);
//echo "<br><br>";

// find the last object within my array to create the key for the object I'm about to insert
if (count($j) == 0){
	$objectCount = 1;
} else {
	$objectCount = count($j) + 1;
}

$k = "object".$objectCount;

//format the id
$i = end($j)["id"];
$i = ++$i;

//echo "<br><br>ID: $i<hr>";
//echo "<br><br>KEY: $k<hr>";
//echo "<br><br>";

// insert my variables into an array stored in a variable called $add
$add = array(
	"id" => $i,
	"name" => $n,
	"gender" => $g
);
//print_r ($add);

// append my new array into the json array
$j[$k] = $add;
//echo "<br><br>NEW ARRAY<hr>";
//print_r ($j);

// take my updated json array, format it back into Json and Overwrite it into the Json file
$ju = json_encode($j);
file_put_contents('ppl.json', $ju);

// Store the image on my service
$t = $_FILES['photo']['tmp_name'];
$f = "img/$i.jpg";
move_uploaded_file( $t, $f);
?>