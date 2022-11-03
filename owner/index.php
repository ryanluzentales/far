<?php
session_start();
include('includes/config.php');
error_reporting(0);

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
</head>

<body>


    <!--Header-->
    <?php include('includes/header.php'); ?>
    <!-- /Header -->




    <!-- Resent Cat-->
    <section class="section-padding gray-bg">
        <div class="container">

            <div class="row">

                <!-- Nav tabs -->

                <!-- Recently Listed New Cars -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="resentnewcar">

                        <?php $sql = "SELECT tblrooms.VehiclesTitle,tblapartments.FromDate,tblrooms.PricePerDay,tblrooms.FuelType,tblrooms.ModelYear,tblrooms.id,tblrooms.SeatingCapacity,tblrooms.VehiclesOverview,tblrooms.Vimage1 from tblrooms join tblapartments on tblapartments.id=tblrooms.VehiclesBrand limit 9";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {
                        ?>

                                <div class="col-list-3">
                                    <div class="recent-car-list">
                                        <div class="car-info-box"> <a href="room-details.php?vhid=<?php echo htmlentities($result->id); ?>"><img src="../admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" class="img-responsive" alt="image"></a>
                                            <ul>
                                                <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->FuelType); ?>
                                                </li>
                                                <!-- <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear); ?>
                                                    Type</li> -->
                                                <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity); ?>
                                                    Person</li>
                                            </ul>
                                        </div>
                                        <div class="car-title-m">
                                            <h6><a href="room-details.php?vhid=<?php echo htmlentities($result->id); ?>">
                                                    <?php echo htmlentities($result->VehiclesTitle); ?></a></h6>
                                            <span class="price">$<?php echo htmlentities($result->PricePerDay); ?> /Day</span>
                                        </div>
                                        <div class="inventory_info_m">
                                            <p><?php echo substr($result->VehiclesOverview, 0, 70); ?></p>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>

                    </div>
                </div>
            </div>
    </section>
    <!-- /Resent Cat -->



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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/interface.js"></script>
    <script src="assets/js/bootstrap-slider.min.js"></script>
    <!--Slider-JS-->
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>

</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->

</html>