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
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
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

                        <?php $sql = "SELECT tblrooms.Apartmentname,tblrooms.RoomName,tblrooms.Landmark,tblapartments.Apartmentname,tblrooms.Address,tblrooms.PricePerDay,tblrooms.BathType,tblrooms.Housingtype,tblrooms.id,tblrooms.SeatingCapacity,tblrooms.Overview,tblrooms.Vimage1 from tblrooms join tblapartments on tblapartments.id=tblrooms.Apartmentname limit 9";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {
                        ?>

                        <div class="col-list-3">
                            <div class="recent-car-list">
                                <div class="car-info-box"> <a
                                        href="room-details.php?vhid=<?php echo htmlentities($result->id); ?>"><img
                                            src="../admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>"
                                            class="img-responsive" alt="image"></a>
                                    <ul>
                                        <li>
                                            <?php 
                                            if($result->Roomstatus==0)
                                            {?>
                                            <div class="occu" style="background-color: green;
  width: 100%;
  height: 30%;
  color: white;
  margin-top: 8px;
  margin-bottom: 8px;
  font-weight: bold;
  text-transform: uppercase;
  border-radius: 10px;
  padding-left: 10px;
  padding-right: 10px;background-color: green;">
                                                <?php echo htmlentities('Available'); ?></div>
                                            <?php 
                                            } else if ($result->Roomstatus==1) {?>


                                            <div class="occu" style="background-color: red;
  width: 100%;
  height: 30%;
  color: white;
  margin-top: 8px;
  margin-bottom: 8px;
  font-weight: bold;
  text-transform: uppercase;
  border-radius: 10px;
  padding-left: 10px;
  padding-right: 10px;background-color: red;">
                                                <?php echo htmlentities('Occupied'); ?> </div>

                                            <?php 
                                            }?>

                                        </li>
                                        <li><i aria-hidden="true"></i><?php echo htmlentities($result->BathType); ?>
                                        </li>

                                        <li><i class="fa fa-user"
                                                aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity); ?>
                                            Person</li>


                                    </ul>
                                </div>
                                <div class="car-title-m">
                                    <h6><a href="room-details.php?vhid=<?php echo htmlentities($result->id); ?>">
                                            <?php echo htmlentities($result->Landmark); ?></a></h6>
                                    <br>
                                    <h6><a href="room-details.php?vhid=<?php echo htmlentities($result->id); ?>">
                                            <?php echo htmlentities($result->RoomName); ?></a></h6>

                                    <br>
                                    <h6><a href="room-details.php?vhid=<?php echo htmlentities($result->id); ?>">
                                            <?php echo htmlentities($result->Apartmentname); ?></a></h6>

                                    <span class="price">₱<?php echo htmlentities($result->PricePerDay); ?> /Month</span>
                                </div>
                                <div class="inventory_info_m">
                                    <p> <?php echo htmlentities($result->Address); ?></p>
                                    <p><?php echo substr($result->Overview, 0, 70); ?></p>
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