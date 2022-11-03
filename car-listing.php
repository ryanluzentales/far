<?php
session_start();
include('includes/config.php');
error_reporting(0);
?>

<!DOCTYPE HTML>
<html lang="en">

<head>

    <title>FAR | Room Listing</title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <!--Custome Style -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <!--OWL Carousel slider-->
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <!--slick-slider -->
    <link href="assets/css/slick.css" rel="stylesheet">
    <!--bootstrap-slider -->
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <!--FontAwesome Font Style -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">



    <!-- Fav and touch icons -->
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


    <!--Listing-->
    <section class="listing-page">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-push-3">
                    <div class="result-sorting-wrapper">
                        <div class="sorting-count">
                            <?php
              //Query for Listing count
              $sql = "SELECT id from tblrooms";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $cnt = $query->rowCount();
              ?>
                            <p><span><?php echo htmlentities($cnt); ?> Listings</span></p>
                        </div>
                    </div>

                    <?php $sql = "SELECT tblrooms.*,tblapartments.FromDate,tblapartments.id as bid  from tblrooms join tblapartments on tblapartments.id=tblrooms.VehiclesBrand";
          $query = $dbh->prepare($sql);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          $cnt = 1;
          if ($query->rowCount() > 0) {
            foreach ($results as $result) {  ?>
                    <div class="product-listing-m gray-bg">
                        <div class="product-listing-img"><img
                                src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>"
                                class="img-responsive" alt="Image" /> </a>
                        </div>
                        <div class="product-listing-content">
                            <h5><a href="room-details.php?vhid=<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->FromDate); ?>
                                    , <?php echo htmlentities($result->VehiclesTitle); ?></a></h5>
                            <p class="list-price">$<?php echo htmlentities($result->PricePerDay); ?> Per Day</p>
                            <ul>
                                <li><i class="fa fa-user"
                                        aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity); ?>
                                    seats</li>
                                <li><i class="fa fa-calendar"
                                        aria-hidden="true"></i><?php echo htmlentities($result->ModelYear); ?> model
                                </li>
                                <li><i class="fa fa-car"
                                        aria-hidden="true"></i><?php echo htmlentities($result->FuelType); ?></li>
                            </ul>
                            <a href="room-details.php?vhid=<?php echo htmlentities($result->id); ?>" class="btn">View
                                Details <span class="angle_arrow"><i class="fa fa-angle-right"
                                        aria-hidden="true"></i></span></a>
                        </div>
                    </div>
                    <?php }
          } ?>
                </div>

                <!--Side-Bar-->
                <aside class="col-md-3 col-md-pull-9">
                    <div class="sidebar_widget">
                        <div class="widget_heading">
                            <h5><i class="fa fa-filter" aria-hidden="true"></i> Find A Room</h5>
                        </div>
                        <div class="sidebar_filter">
                            <form action="search-carresult.php" method="post">
                                <div class="form-group select">
                                    <select class="form-control" name="brand">
                                        <option>Select Apartment</option>

                                        <?php $sql = "SELECT * from  tblapartments ";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                      foreach ($results as $result) {       ?>
                                        <option value="<?php echo htmlentities($result->id); ?>">
                                            <?php echo htmlentities($result->FromDate); ?></option>
                                        <?php }
                    } ?>

                                    </select>
                                </div>
                                <div class="form-group select">
                                    <select class="form-control" name="fueltype">
                                        <option>Bath Type</option>
                                        <option value="Petrol">Private Bath</option>
                                        <option value="Diesel">Shared Bath</option>
                                        
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-block"><i class="fa fa-search"
                                            aria-hidden="true"></i>Search Room</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="sidebar_widget">
                        <div class="widget_heading">
                            <h5><i class="fa fa-car" aria-hidden="true"></i> Recently Listed Rooms</h5>
                        </div>
                        <div class="recent_addedcars">
                            <ul>
                                <?php $sql = "SELECT tblrooms.*,tblapartments.FromDate,tblapartments.id as bid  from tblrooms join tblapartments on tblapartments.id=tblrooms.VehiclesBrand order by id desc limit 4";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) {  ?>

                                <li class="gray-bg">
                                    <div class="recent_post_img"> <a
                                            href="room-details.php?vhid=<?php echo htmlentities($result->id); ?>"><img
                                                src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>"
                                                alt="image"></a> </div>
                                    <div class="recent_post_title"> <a
                                            href="room-details.php?vhid=<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->FromDate); ?>
                                            , <?php echo htmlentities($result->VehiclesTitle); ?></a>
                                        <p class="widget_price">$<?php echo htmlentities($result->PricePerDay); ?> Per
                                            Day</p>
                                    </div>
                                </li>
                                <?php }
                } ?>

                            </ul>
                        </div>
                    </div>
                </aside>
                <!--/Side-Bar-->
            </div>
        </div>
    </section>
    <!-- /Listing-->


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

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/interface.js"></script>

    <!--bootstrap-slider-JS-->
    <script src="assets/js/bootstrap-slider.min.js"></script>
    <!--Slider-JS-->
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>

</body>

</html>