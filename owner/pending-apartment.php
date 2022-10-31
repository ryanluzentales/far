<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['ologin']) == 0) {
    header('location:index.php');
} else {
?>
    <!DOCTYPE HTML>
    <html lang="en">

    <head>

        <title>Car Rental Portal - My Booking</title>
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
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
        <!-- Google-Font-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    </head>

    <body>



        <!--Header-->
        <?php include('includes/header.php'); ?>



        <?php
        $useremail = $_SESSION['ologin'];
        $sql = "SELECT * from tblowner where EmailId=:useremail ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
            foreach ($results as $result) { ?>
                <section class="user_profile inner_pages">
                    <div class="container">

                        <div class="dealer_info">
                            <?php echo htmlentities($result->City); ?>&nbsp;<?php echo htmlentities($result->Country);
                                                                        }
                                                                    } ?></p>
                        </div>

                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <?php include('includes/sidebar.php'); ?>

                                <div class="col-md-8 col-sm-8">
                                    <div class="profile_wrap">
                                        <h5 class="uppercase underline">My Apartments </h5>
                                        <div class="my_vehicles_list">
                                            <ul class="vehicle_listing">
                                                <?php
                                                $useremail = $_SESSION['ologin'];
                                                $sql = "SELECT tblbookings.FromDate,tblbookings.ToDate,tblbookings.message,tblbookings.Status,tblbookings.BookingNumber from tblbookings join verify on tblbookings.BookingNumber=verify.BookingNumber where tblbookings.userEmail=:useremail order by tblbookings.id desc";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {  ?>

                                                        <li>
                                                        <h4 style="color:red">Booking No
                                                                #<?php echo htmlentities($result->BookingNumber); ?></h4>
                    
                                                            <div class="vehicle_title">                                                           
                                                                <p><b>From </b> <?php echo htmlentities($result->FromDate); ?> <b>To </b>
                                                                    <?php echo htmlentities($result->ToDate); ?></p>
                                                                <div style="float: left">
                                                                    <p><b>Message:</b> <?php echo htmlentities($result->message); ?> </p>
                                                                </div>
                                                            </div>
                                                            <?php if ($result->Status == 1) { ?>
                                                                <div class="vehicle_status"> <a href="#" class="btn outline btn-xs active-btn">Confirmed</a>
                                                                    <div class="clearfix"></div>
                                                                </div>

                                                            <?php } else if ($result->Status == 2) { ?>
                                                                <div class="vehicle_status"> <a href="#" class="btn outline btn-xs">Cancelled</a>
                                                                    <div class="clearfix"></div>
                                                                </div>



                                                            <?php } else { ?>
                                                                <div class="vehicle_status"> <a href="#" class="btn outline btn-xs">Not Confirm
                                                                        yet</a>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                            <?php } ?>

                                                        </li>

                                                       >
                                                       
                                                        <hr />
                                                    <?php }
                                                } else { ?>
                                                    <h5 align="center" style="color:red">No booking yet</h5>
                                                <?php } ?>


                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
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
<?php } ?>