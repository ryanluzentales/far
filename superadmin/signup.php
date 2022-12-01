<?php
session_start();
error_reporting(0);
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
    $fullname = $_POST["fullname"];
    $address = $_POST["address"];
    $contactnumber = $_POST["contactnumber"];
	$password = $_POST["password"];
	$cpassword = $_POST["cpassword"];

			
	
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
	$exists="Username is already exist!";
}
	
}//end if
	
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title>FAR | SuperAdmin Dashboard</title>
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


                <?php
	
	if($showAlert) {
	
		echo '<div class="alert alert-warning alert-dismissible" data-mdb-delay="3000". role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 Admin aacount successfully created
</div>';
	}
	
	if($showError) {

    echo '<div class="bs-example">
    <div class="alert alert-danger fade in">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong> Password do not match!</strong>
</div>';
}
		
	if($exists) {
         echo ' <div class="alert alert-warning alert-dismissible" role="alert"> '. $exists.'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong></strong>
</div>';
		
	}

?>
                <div class="container my-4 ">

                    <h1 class="text-center">Create Admin Accounts</h1>
                    <form action="signup.php" method="post">

                        <div class="form-group">
                            <label for="username">Username*</label>
                            <input type="text" class="form-control" id="username" name="username"
                                aria-describedby="emailHelp" required>
                        </div>

                        <div class="form-group">
                            <label for="fullname">Full Name*</label>
                            <input type="text" class="form-control" id="fullname" name="fullname"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address*</label>
                            <input type="text" class="form-control" id="address" name="address"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="contactnumber">Contact Number*</label>
                            <input type="text" class="form-control" id="contactnumber" name="contactnumber"
                                aria-describedby="emailHelp" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password*</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="cpassword">Confirm Password*</label>
                            <input type="password" class="form-control" id="cpassword" name="cpassword" required>

                            <small id="emailHelp" class="form-text text-muted">
                                Make sure to type the same password
                            </small>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            SignUp
                        </button>

                    </form>
                </div>




            </div>
        </div>
    </div>
    </div>
</body>

</html>
<?php } ?>


<?php // if (!($_POST['result'])) echo $_POST['username'];  add value=""?>