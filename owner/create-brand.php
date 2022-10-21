<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	// Code for change password	
	if (isset($_POST['submit'])) {
		$brand = $_POST['brand'];
		$address = $_POST['address'];
		$sql = "INSERT INTO  tblbrands(BrandName, address) VALUES(:brand,:address)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':brand', $brand, PDO::PARAM_STR);
		$query->bindParam(':address', $address, PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if ($lastInsertId) {
			$msg = "Brand Created successfully";
		} else {
			$error = "Something went wrong. Please try again";
		}
	}
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

    <title>FAR | Create Apartment</title>

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
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/leftbar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <h2 class="page-title">Create Apartment</h2>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Create Apartment</div>
                                    <div class="panel-body">
                                        <form method="post" name="chngpwd" class="form-horizontal"
                                            onSubmit="return valid();">
                                            <?php if ($error) { ?><div class="errorWrap">
                                                <strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                                            </div>
                                            <?php } else if ($msg) { ?><div class="succWrap">
                                                <strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
                                            </div>
                                            <?php } ?>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Apartment Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="brand" id="brand"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <?php
													if (isset($_POST["submit_address"])) {
														$address = $_POST["address"];
														$address = str_replace(" ", "+", $address);
													?>
                                                <?php
													}
													?>
                                                <form method="POST">
                                                    <label class=" col-sm-2 control-label">Address<span
                                                            style="color:red">*</span></label>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="address" class="form-control" required>
                                                    </div>

                                                    <iframe width="100%" height="500"
                                                        src="https://maps.google.com/maps?q=<?php echo $address; ?>&output=embed"></iframe>
                                                    <input id="formSubmit" type="submit"></input>
                                                </form>
                                            </div>

                                            <div class="form-group">
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque
                                                    aliquam, non quia praesentium esse autem! Quae voluptatibus vero ad,
                                                    delectus nemo vitae nostrum est. Nihil corporis consequatur cumque
                                                    reprehenderit maxime?</p>
                                                <img src="../assets/imagess/download.png" width="50%" height="250">
                                                </img>
                                                <input type="file"></input>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-4">

                                                    <button class="btn btn-primary" name="submit"
                                                        type="submit">Submit</button>
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- Loading Scripts -->
    <script src="../owner/js/refresh.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>

</body>

</html>
<?php } ?>