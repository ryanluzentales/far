<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (isset($_POST['submit'])) {
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $message = $_POST['message'];
    $useremail = $_SESSION['ologin'];
    $status = 0;
    $vhid = $_GET['vhid'];
    $bookingno = $_GET['bookingno'];
    $bookingno = mt_rand(100000000, 999999999);
    $ret = "SELECT * FROM tblbookings where (:fromdate BETWEEN date(FromDate) and date(ToDate) || :todate BETWEEN date(FromDate) and date(ToDate) || date(FromDate) BETWEEN :fromdate and :todate) and VehicleId=:vhid";
    $query1 = $dbh->prepare($ret);
    $query1->bindParam(':vhid', $vhid, PDO::PARAM_STR);
    $query1->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
    $query1->bindParam(':todate', $todate, PDO::PARAM_STR);
    $query1->execute();
    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);

    if ($query1->rowCount() == 0) {

        $sql = "INSERT INTO tblbookings(BookingNumber,userEmail,VehicleId,FromDate,ToDate,message,Status) VALUES(:bookingno,:useremail,:bookingno,:fromdate,:todate,:message,:status); INSERT INTO verify(BookingNumber) VALUES(:bookingno)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookingno', $bookingno, PDO::PARAM_STR);
        $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
        $query->bindParam(':vhid', $vhid, PDO::PARAM_STR);
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
    } else {
        echo "<script>alert('ROom already booked for these days');</script>";
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
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
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

    <!--Listing-Image-Slider-->

    <?php
    $vhid = intval($_GET['vhid']);
    $sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:vhid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':vhid', $vhid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
            $_SESSION['brndid'] = $result->bid;
    ?>

            <section id="listing_img_slider">
                <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" class="img-responsive" alt="image" width="900" height="560"></div>
                <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage2); ?>" class="img-responsive" alt="image" width="900" height="560"></div>
                <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage3); ?>" class="img-responsive" alt="image" width="900" height="560"></div>
                <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage4); ?>" class="img-responsive" alt="image" width="900" height="560"></div>
                <?php if ($result->Vimage5 == "") {
                } else {
                ?>
                    <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage5); ?>" class="img-responsive" alt="image" width="900" height="560"></div>
                <?php } ?>
            </section>



            <!--Listing-detail-->
            <section class="listing-detail">
                <div class="container">
                    <div class="listing_detail_head row">
                        <div class="col-md-9">
                            <h2><?php echo htmlentities($result->BrandName); ?> ,
                                <?php echo htmlentities($result->VehiclesTitle); ?></h2>
                        </div>
                        <div class="col-md-3">
                            <div class="price_info">
                                <p>$<?php echo htmlentities($result->PricePerDay); ?> </p>Per Day

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="main_features">
                                <ul>

                                    <li> <i class="fa fa-home" aria-hidden="true"></i>
                                        <h5><?php echo htmlentities($result->ModelYear); ?></h5>
                                        <p>Housing Type</p>
                                    </li>

                                    <li> <i class="fa fa-home" aria-hidden="true"></i>
                                        <h5><?php echo htmlentities($result->FuelType); ?></h5>
                                        <p>Type of Room</p>
                                    </li>

                                    <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
                                        <h5><?php echo htmlentities($result->SeatingCapacity); ?></h5>
                                        <p>Availability</p>

                                    <li> <i class="fa fa-pencil" aria-hidden="false"></i>
                                        <a href="review-room.php?vhid=<?php echo htmlentities($result->id); ?>"> Reviews</a>
                                    </li>
                                    </li>
                                </ul>
                            </div>
                    <?php }
            } ?>

                        </div>

                        <!--Side-Bar-->
                        <aside class="col-md-3">


                            <div class="sidebar_widget">
                                <div class="widget_heading">
                                    <h5><i aria-hidden="true"></i>Post apartment</h5>
                                </div>
                                <form method="post">
                                    <div class="form-group">
                                        <label>Apartment Name:</label>
                                        <input type="text" class="form-control" name="fromdate" placeholder="From Date" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Address:</label>
                                        <input type="text" class="form-control" name="todate" placeholder="To Date" required>
                                    </div>
                                    <div class="form-group">
                                        <textarea rows="4" class="form-control" name="message" placeholder="Message" required></textarea>
                                    </div>
                                    <?php if ($_SESSION['ologin']) { ?>
                                        <div class="form-group">
                                            <input type="submit" class="btn" name="submit" value="Submit">
                                        </div>
                                    <?php } else { ?>
                                        <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Submit</a>

                                    <?php } ?>
                                </form>
                            </div>
                        </aside>
                        <!--/Side-Bar-->
                    </div>

                    <div class="space-20"></div>
                    <div class="divider"></div>



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
<?php showComments(); ?>

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