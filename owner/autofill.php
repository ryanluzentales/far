<?php

// Get the user id
$brandname = $_REQUEST['brandname'];

// Database connection
$con = mysqli_connect("localhost", "root", "", "far_db");

if ($brandname !== "") {
	
	// Get corresponding first name and
	// last name for that user id	
	$query = mysqli_query($con, "SELECT Address,
	message, HousingType FROM tblapartments WHERE id='$brandname'");

	$row = mysqli_fetch_array($query);

	// Get the first name
	$Address = $row["Address"];

	// Get the first name
	$message = $row["message"];
	
	$HousingType = $row["HousingType"];
}

// Store it in a array
$result = array("$Address", "$message", "$HousingType");

// Send in JSON encoded form
$myJSON = json_encode($result);
echo $myJSON;
?>