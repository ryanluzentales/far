<?php

// Get the user id
$brandname = $_REQUEST['brandname'];

// Database connection
$con = mysqli_connect("localhost", "root", "", "far_db");

if ($brandname !== "") {
	
	// Get corresponding first name and
	// last name for that user id	
	$query = mysqli_query($con, "SELECT Address,
	Landmark, HousingType FROM tblapartments WHERE id='$brandname'");

	$row = mysqli_fetch_array($query);

	// Get the first name
	$Address = $row["Address"];

	// Get the first name
	$Landmark = $row["Landmark"];
	
	$HousingType = $row["HousingType"];
}

// Store it in a array
$result = array("$Address", "$Landmark", "$HousingType");

// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>