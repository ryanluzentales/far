<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['ologin']) == 0) {
	header('location:index.php');
} else {
	// Code for change password	
	if (isset($_POST['submit'])) {
		$brand = $_POST['brand'];
		$id = $_GET['id'];
		$sql = "update  tblbrands set BrandName=:brand where id=:id";
		$query = $dbh->prepare($sql);
		$query->bindParam(':brand', $brand, PDO::PARAM_STR);
		$query->bindParam(':id', $id, PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();

		$msg = "Brand Update successfully";
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

		<title>Find a room | Owner Update Apartment</title>

		<link rel="stylesheet" href="./assets/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="./assets/css/style.css" type="text/css">
		<link rel="stylesheet" href="./assets/css/owl.carousel.css" type="text/css">
		<link rel="stylesheet" href="./assets/css/owl.transitions.css" type="text/css">
		<link href="./assets/css/slick.css" rel="stylesheet">
		<link href="./assets/css/bootstrap-slider.min.css" rel="stylesheet">
		<link href="./assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="./assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="./assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="./assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="./assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="./assets/images/favicon-icon/favicon.png">
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

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
		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #dd3d36;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #5cb85c;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>


	</head>

	<body>
		<?php include('includes/header.php'); ?>
		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title">Update Apartment</h2>

							<div class="row">
								<div class="col-md-10">
									<div class="panel panel-default">
										<div class="panel-heading">Update Brand</div>
										<div class="panel-body">
											<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">


												<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

												<?php
												$id = $_GET['id'];
												$ret = "select * from tblbrands where id=:id";
												$query = $dbh->prepare($ret);
												$query->bindParam(':id', $id, PDO::PARAM_STR);
												$query->execute();
												$results = $query->fetchAll(PDO::FETCH_OBJ);
												$cnt = 1;
												if ($query->rowCount() > 0) {
													foreach ($results as $result) {
												?>

														<div class="form-group">
															<label class="col-sm-4 control-label">Brand Name</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" value="<?php echo htmlentities($result->BrandName); ?>" name="brand" id="brand" required>
															</div>
														</div>
														<div class="hr-dashed"></div>

												<?php }
												} ?>


												<div class="form-group">
													<div class="col-sm-8 col-sm-offset-4">

														<button class="btn btn-primary" name="submit" type="submit">Submit</button>
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
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="js/Chart.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/chartData.js"></script>
		<script src="js/main.js"></script>

		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/interface.js"></script>
		<script src="assets/js/bootstrap-slider.min.js"></script>
		<!--Slider-JS-->
		<script src="assets/js/slick.min.js"></script>
		<script src="assets/js/owl.carousel.min.js"></script>

	</body>

	</html>
<?php } ?>