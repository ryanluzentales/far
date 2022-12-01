<?php
session_start();
//error_reporting(0);
include('includes/config.php');
$showAlert = false;
$showError = false;
$exists=false;
	
if(!isset($_SESSION['UserData']['Username'])){
	header("location:login.php");
}
else{
	

if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	// Include file which makes the
	// Database Connection.
	include('includes/config2.php');
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	$cpassword = $_POST["cpassword"];
    $fullname =$_POST["fullname"];
    $address =$_POST["address"];
    $contactnumber =$_POST["contactnumber"];
			
	
	$sql = "Select * from admin where UserName='$username'";
	
	$result = mysqli_query($conn, $sql);
	
	$num = mysqli_num_rows($result);
	
	if($num == 0) {
		if(($password == $cpassword)) {
	
			$hash = md5($password);
				
			// Password Hashing is used here.
			$sql = "INSERT INTO `admin` ( `UserName`, `Fullname`, `Address`, `Contactnumber`,
				`Password`, `updationDate`) VALUES ('$username', '$fullname', '$address', '$contactnumber',
				'$hash', current_timestamp())";
	
			$result = mysqli_query($conn, $sql);
	
			if ($result) {
				$showAlert = true;
			}
		}
		else {
			$showError = "Passwords do not match";
		}	
	}// end if
	
if($num>0)
{
	$exists="Username not available";
}
	
}//end if
	
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>


<body>
    <?php include('includes/header.php');?>

    <div class="ts-main-content">
        <?php include('includes/leftbar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <center>
                    <h2> WELCOME SUPERADMIN</h2>
                </center>

            </div>
        </div>
    </div>
    </div>


</body>

</html>
<?php } ?>