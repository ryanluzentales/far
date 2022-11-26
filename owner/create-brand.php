<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('session.php');



if (strlen($_SESSION['ologin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        $user_id = $_SESSION['ologin'];
        $brand = $_POST['brand'];
        $address = $_POST['address'];
        $sql = "INSERT INTO  tblapartments(Apartmentname, address) VALUES(:brand,:address)";
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

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <link href="assets/css/slick.css" rel="stylesheet">
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
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
    <link rel="stylesheet" href="assets/css/style.css">



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
                        <?php echo $user_id ?>


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
                                                <label class="col-sm-2 control-label">Apartment Name</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="brand" id="brand"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <label class=" col-sm-2 control-label">Address<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-6">
                                                    <input type="text" name="address" class="form-control" required>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <h6>You can pay using the details below</h6>
                                                <p>BPI: 1234-8643-1234</p>
                                                <p>BDO: 1234-8643-1234</p>
                                                <p>GCASH: 1234-8643-1234</p>
                                                <h6>You can also pay through GCASH using the QR Code provided below</h6>
                                                <p>After paying, please upload the receipt on the upload file button
                                                    below.</p>
                                                <p>The Apartment will be posted once the administrator confirmed the
                                                    payment and details</p>

                                                <img src="../assets/imagess/download.png" width="25%" height="250">
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
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>


    <?php include('includes/forgotpassword.php'); ?>
    <!--/Forgot-password-Form -->

    <!-- Scripts -->
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