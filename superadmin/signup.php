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
	$password = $_POST["password"];
	$cpassword = $_POST["cpassword"];
			
	
	$sql = "Select * from admin where UserName='$username'";
	
	$result = mysqli_query($conn, $sql);
	
	$num = mysqli_num_rows($result);
	
	if($num == 0) {
		if(($password == $cpassword)) {
	
			$hash = md5($password);
				
			// Password Hashing is used here.
			$sql = "INSERT INTO `admin` ( `UserName`,
				`Password`, `updationDate`) VALUES ('$username',
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title>FAR | Admin Dashboard</title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <!-- Bootstrap social button library -->
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="css/fileinput.min.css">
    <!-- Awesome Bootstrap checkbox -->
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <!-- Admin Stye -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('includes/header.php');?>

    <div class="ts-main-content">
        <?php include('includes/leftbar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">


                <?php
	
	if($showAlert) {
	
		echo ' <div class="alert alert-success
			alert-dismissible fade show" role="alert">
	
			<strong>Success!</strong> Your account is
			now created and you can login.
			<button type="button" class="close"
				data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div> ';
	}
	
	if($showError) {
	
		echo ' <div class="alert alert-danger
			alert-dismissible fade show" role="alert">
		<strong>Error!</strong> '. $showError.'
	
	<button type="button" class="close"
			data-dismiss="alert aria-label="Close">
			<span aria-hidden="true">×</span>
	</button>
	</div> ';
}
		
	if($exists) {
		echo ' <div class="alert alert-danger
			alert-dismissible fade show" role="alert">
	
		<strong>Error!</strong> '. $exists.'
		<button type="button" class="close"
			data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div> ';
	}

?>

                <div class="container my-4 ">

                    <h1 class="text-center">Create Admin Accounts</h1>
                    <form action="signup.php" method="post">

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                aria-describedby="emailHelp">
                        </div>

                        <div class="form-group">
                            <label for="username">Full Name</label>
                            <input type="text" class="form-control" id="username" name="username"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="username">Address</label>
                            <input type="text" class="form-control" id="username" name="username"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="username">Contact Number</label>
                            <input type="text" class="form-control" id="username" name="username"
                                aria-describedby="emailHelp">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="form-group">
                            <label for="cpassword">Confirm Password</label>
                            <input type="password" class="form-control" id="cpassword" name="cpassword">

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

    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>

    <script>
    window.onload = function() {

        // Line chart from swirlData for dashReport
        var ctx = document.getElementById("dashReport").getContext("2d");
        window.myLine = new Chart(ctx).Line(swirlData, {
            responsive: true,
            scaleShowVerticalLines: false,
            scaleBeginAtZero: true,
            multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
        });

        // Pie Chart from doughutData
        var doctx = document.getElementById("chart-area3").getContext("2d");
        window.myDoughnut = new Chart(doctx).Pie(doughnutData, {
            responsive: true
        });

        // Dougnut Chart from doughnutData
        var doctx = document.getElementById("chart-area4").getContext("2d");
        window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {
            responsive: true
        });

    }
    </script>
</body>

</html>
<?php } ?>