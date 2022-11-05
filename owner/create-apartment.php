<?php
session_start();
include('includes/config.php');
//error_reporting(0);
if (isset($_POST['submit'])) {
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $message = $_POST['message'];
    $gender = $_POST['gender'];
    $useremail = $_SESSION['ologin'];
    $status = 0;
    $paymentreceipt = $_FILES["payment"]["name"];
    $bookingno = mt_rand(100000000, 999999999);
    move_uploaded_file($_FILES["payment"]["tmp_name"], "../admin/img/payment/" . $_FILES["payment"]["name"]);

    $sql = "INSERT INTO tblapartments(BookingNumber,userEmail,VehicleId,FromDate,ToDate,message,gender,Payment,Status) VALUES(:bookingno,:useremail,:bookingno,:fromdate,:todate,:message,:gender,:paymentreceipt,:status); INSERT INTO verify(BookingNumber) VALUES(:bookingno)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':bookingno', $bookingno, PDO::PARAM_STR);
    $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
    $query->bindParam(':gender', $gender, PDO::PARAM_STR);
    $query->bindParam(':paymentreceipt', $paymentreceipt, PDO::PARAM_STR);
    $query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
    $query->bindParam(':todate', $todate, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "<script>alert('Booking successfull.');</script>";
        echo "<script type='text/javascript'> document.location = 'pending-apartment.php'; </script>";
    } else {
         echo "<script>alert('Something went wrong. Please try again');</script>";
         echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
     }
  } 

?>


<!DOCTYPE HTML>
<html lang="en">

<head>

    <title>Find a Room</title>
    <!--Bootstrap -->
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
    <!-- owner Stye -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>



    <!--Header-->
    <?php include('includes/header.php'); ?>
    <!-- /Header -->


    <section class="listing-detail">
        <div class="container">

            <div class="row">
                <div class="col-md-9">

                </div>

                <!--Side-Bar-->
                <aside class="col-md-3">
                    <div class="sidebar_widget">
                        <div class="widget_heading">
                            <h5><i aria-hidden="true"></i>Post apartment</h5>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Apartment Name:</label>
                                <input type="text" class="form-control" name="fromdate" placeholder="Apartment Name"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Address:</label>
                                <input type="text" class="form-control" name="todate" placeholder="Address" required>
                            </div>
                            <div class="form-group">
                                <label>Landmark:</label>
                                <input type="text" class="form-control" name="message" placeholder="Landmaek">
                            </div>
                            <div class="form-group">
                                <label>Gender:</label> <br>
                                <select class="selectpicker" name="gender" required>
                                    <option value=""> Select </option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Mixed">Mixed</option>
                                </select>
                            </div>
                            <div>
                                <p>For payment you may use the details below:</p>
                                <p>BPI:</p>
                                <p>Union Bank:</p>
                                <p>Gcash:</p>
                                <p>Please upload your proof of payment below:</p>
                            </div>

                            <div class="form-group">
                                <label>Proof of Paymnet</label>
                                <input type="file" class="form-control" name="payment" placeholder="Proof of Payment">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn" name="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </aside>
                <!--/Side-Bar-->
            </div>

        </div>
    </section>
    <!--/Listing-detail-->

    <!--Back to top-->
    <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
    <!--/Back to top-->

    <!--Login-Form -->


    <!--Back to top-->
    <div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
    <!--/Back to top-->

    <!--Login-Form -->
    <?php include('includes/login.php'); ?>
    <!--/Login-Form -->

    <!--Register-Form -->
    <?php include('includes/registration.php'); ?>

    <!--/Register-Form -->

    <!--Forgot-password-Form -->
    <?php include('includes/forgotpassword.php'); ?>
    <!--/Forgot-password-Form -->

    <!-- Scripts -->
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

<!-- Amenities -->
<!-- 

Kitchen
Free Parking on premises
TV
Wifi
Air conditioning
Single Bed
Double Deck bed


-->