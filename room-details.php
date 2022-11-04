<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (isset($_POST['submit'])) {
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $message = $_POST['message'];
    $useremail = $_SESSION['login'];
    $status = 0;
    $vhid = $_GET['vhid'];
    $bookingno = mt_rand(100000000, 999999999);
    $ret = "SELECT * FROM tblbooking where (:fromdate BETWEEN date(FromDate) and date(ToDate) || :todate BETWEEN date(FromDate) and date(ToDate) || date(FromDate) BETWEEN :fromdate and :todate) and VehicleId=:vhid";
    $query1 = $dbh->prepare($ret);
    $query1->bindParam(':vhid', $vhid, PDO::PARAM_STR);
    $query1->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
    $query1->bindParam(':todate', $todate, PDO::PARAM_STR);
    $query1->execute();
    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);

    if ($query1->rowCount() == 0) {

        $sql = "INSERT INTO  tblbooking(BookingNumber,userEmail,VehicleId,FromDate,ToDate,message,Status) VALUES(:bookingno,:useremail,:vhid,:fromdate,:todate,:message,:status)";
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
            echo "<script type='text/javascript'> document.location = 'my-booking.php'; </script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
            echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
        }
    } else {
        echo "<script>alert('ROom already booked for these days');</script>";
        echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
    }
}


function showComments()
{
    $comment = "";

    $comment .= commenttree();

    echo $comment;
}

function commenttree($parentid = NULL)
{
    $comments = '';
    $sql = '';

    if (is_null($parentid)) {
        $sql = "select * from comments where comment_id='0'";
    } else {
        $sql = "select * from comments where comment_id=$parentid";
    }


    $result = mysqli_query($GLOBALS['conn'], $sql);

    while ($data = mysqli_fetch_array($result)) {

        if ($data['comment_id'] == '0') {
            $comments .= '
		 <div class="media border comment0 p-3">
    <div class="media-body">
      <h4>' . $data['name'] . '<small><i> Posted on February 19, 2016</i></small></h4>
     
	 ' . $data['description'] . '
      
	  <p><a href="#postcomment" class="btn btn-primary mt-2 float-right" onclick="reply(' . $data['id'] . ')">reply</a></p>
	 </div>
	 </div>
	  ';
        } else {
            $comments .= '<div class="media border reply p-3">
    <div class="media-body">
      <h4>' . $data['name'] . '<small><i> Posted on February 19, 2016</i></small></h4>
     
	 ' . $data['description'] . '
      
	  <p><a href="#postcomment" class="btn btn-primary mt-2 float-right" onclick="reply(' . $data['id'] . ')">reply</a></p>
	  </div>
	  </div>
	  ';
        }


        $comments .= '<div class="media  parent  p-3">
    <div class="media-body">' . commenttree($data['id']) . '</div></div>';
    }


    return $comments;
}


$vhid = $_GET['vhid'];

if (isset($_POST['submit'])) {

    if (empty($_POST['commentid'])) {
        $commentid = '0';
    } else {
        $commentid = $_POST['commentid'];
    }

    $sql = "insert into comments (vhid_id,comment_id,name,description) values ('" . $vhid . "','" . $commentid . "','" . $_POST['name'] . "','" . $_POST['description'] . "')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script>alert("comment added successfully, we will published after verify your comment.")</script>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}



?>


<!DOCTYPE HTML>
<html lang="en">

<head>

    <title>Find a Room</title>
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


    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>



    <!--Header-->
    <?php include('includes/header.php'); ?>
    <!-- /Header -->

    <!--Listing-Image-Slider-->

    <?php
    $vhid = intval($_GET['vhid']);
    $sql = "SELECT tblrooms.*,tblapartments.FromDate, tblapartments.id as bid  from tblrooms join tblapartments on tblapartments.id=tblrooms.VehiclesBrand where tblrooms.id=:vhid";
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
        <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" class="img-responsive"
                alt="image" width="900" height="560"></div>
        <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage2); ?>" class="img-responsive"
                alt="image" width="900" height="560"></div>
        <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage3); ?>" class="img-responsive"
                alt="image" width="900" height="560"></div>
        <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage4); ?>" class="img-responsive"
                alt="image" width="900" height="560"></div>
        <?php if ($result->Vimage5 == "") {
                } else {
                ?>
        <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage5); ?>" class="img-responsive"
                alt="image" width="900" height="560"></div>
        <?php } ?>
    </section>



    <!--Listing-detail-->
    <section class="listing-detail">
        <div class="container">
            <div class="listing_detail_head row">
                <div class="col-md-9">
                    <h2><?php echo htmlentities($result->FromDate); ?> ,
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
                    <div class="listing_more_info">
                        <div class="listing_detail_wrap">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs gray-bg" role="tablist">
                                <li role="presentation" class="active"><a href="#vehicle-overview "
                                        aria-controls="vehicle-overview" role="tab" data-toggle="tab">Room Details
                                    </a></li>

                                <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab"
                                        data-toggle="tab">Inclusions</a></li>

                                <li role="presentation"><a href="#location" aria-controls="location" role="tab"
                                        data-toggle="tab">Location</a></li>

                            </ul>


                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- vehicle-overview -->
                                <div role="tabpanel" class="tab-pane active" id="vehicle-overview">

                                    <p><?php echo htmlentities($result->VehiclesOverview); ?></p>
                                </div>

                                <div role="tabpanel" class="tab-pane" id="ratings">
                                    <div align="center" style="background: lightblue;padding: 50px;color:white;">
                                        <i class="fa fa-star fa-2x" data-index="0"></i>
                                        <i class="fa fa-star fa-2x" data-index="1"></i>
                                        <i class="fa fa-star fa-2x" data-index="2"></i>
                                        <i class="fa fa-star fa-2x" data-index="3"></i>
                                        <i class="fa fa-star fa-2x" data-index="4"></i>

                                        <br><br>
                                        <?php echo round($avg, 2) ?>
                                    </div>
                                    <script src="http://code.jquery.com/jquery-3.4.0.min.js"
                                        integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
                                        crossorigin="anonymous"></script>
                                    <script>
                                    var ratedIndex = -1,
                                        uID = 0;

                                    $(document).ready(function() {
                                        resetStarColors();

                                        if (localStorage.getItem('ratedIndex') != null) {
                                            setStars(parseInt(localStorage.getItem('ratedIndex')));
                                            uID = localStorage.getItem('uID');
                                        }

                                        $('.fa-star').on('click', function() {
                                            ratedIndex = parseInt($(this).data('index'));
                                            localStorage.setItem('ratedIndex', ratedIndex);
                                            saveToTheDB();
                                        });

                                        $('.fa-star').mouseover(function() {
                                            resetStarColors();
                                            var currentIndex = parseInt($(this).data('index'));
                                            setStars(currentIndex);
                                        });

                                        $('.fa-star').mouseleave(function() {
                                            resetStarColors();

                                            if (ratedIndex != -1)
                                                setStars(ratedIndex);
                                        });
                                    });

                                    function saveToTheDB() {
                                        $.ajax({
                                            url: "index.php",
                                            method: "POST",
                                            dataType: 'json',
                                            data: {
                                                save: 1,
                                                uID: uID,
                                                ratedIndex: ratedIndex
                                            },
                                            success: function(r) {
                                                uID = r.id;
                                                localStorage.setItem('uID', uID);
                                            }
                                        });
                                    }

                                    function setStars(max) {
                                        for (var i = 0; i <= max; i++)
                                            $('.fa-star:eq(' + i + ')').css('color', 'green');
                                    }

                                    function resetStarColors() {
                                        $('.fa-star').css('color', 'white');
                                    }
                                    </script>
                                </div>


                                <div role="tabpanel" class="tab-pane" id="location">
                                    <iframe width="100%" height="500"
                                        src="https://maps.google.com/maps?q=<?php echo $result->Address; ?>&output=embed"></iframe>
                                </div>

                                <!-- Accessories -->
                                <div role="tabpanel" class="tab-pane" id="accessories">
                                    <!--Accessories-->
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="2">Inclusions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Wifi</td>
                                                <?php if ($result->AirConditioner == 1) {
                                                        ?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Airconditioner</td>
                                                <?php if ($result->AntiLockBrakingSystem == 1) {
                                                        ?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Single Bed</td>
                                                <?php if ($result->PowerSteering == 1) {
                                                        ?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>


                                            <tr>

                                                <td>Refrigerator</td>

                                                <?php if ($result->PowerWindows == 1) {
                                                        ?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Television</td>
                                                <?php if ($result->CDPlayer == 1) {
                                                        ?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Kitchen</td>
                                                <?php if ($result->LeatherSeats == 1) {
                                                        ?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Shared Bathroom</td>
                                                <?php if ($result->CentralLocking == 1) {
                                                        ?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Private Bathroom</td>
                                                <?php if ($result->PowerDoorLocks == 1) {
                                                        ?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <td>Free Electricity</td>
                                                <?php if ($result->BrakeAssist == 1) {
                                                        ?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php  } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Free Water</td>
                                                <?php if ($result->DriverAirbag == 1) {
                                                        ?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Cabinet</td>
                                                <?php if ($result->PassengerAirbag == 1) {
                                                        ?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                            <tr>
                                                <td>Balcony</td>
                                                <?php if ($result->CrashSensor == 1) {
                                                        ?>
                                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                                <?php } else { ?>
                                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                                <?php } ?>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php }
            } ?>

                </div>

                <!--Side-Bar-->
                <aside class="col-md-3">

                    <div class="share_vehicle">
                        <p>Share: <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a
                                href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="#"><i
                                    class="fa fa-linkedin-square" aria-hidden="true"></i></a> <a href="#"><i
                                    class="fa fa-google-plus-square" aria-hidden="true"></i></a> </p>
                    </div>
                    <div class="sidebar_widget">
                        <div class="widget_heading">
                            <h5><i class="fa fa-envelope" aria-hidden="true"></i>Reserve Now</h5>
                        </div>
                        <form method="post">
                            <div class="form-group">
                                <label>From Date:</label>
                                <input type="date" class="form-control" name="fromdate" placeholder="From Date"
                                    required>
                            </div>
                            <!-- <div class="form-group">
                                <label>To Date:</label>
                                <input type="date" class="form-control" name="todate" placeholder="To Date" required>
                            </div> -->
                            <div class="form-group">
                                <textarea rows="4" class="form-control" name="message" placeholder="Message"
                                    required></textarea>
                            </div>
                            <?php if ($_SESSION['login']) { ?>
                            <div class="form-group">
                                <input type="submit" class="btn" name="submit" value="Book Now">
                            </div>
                            <?php } else { ?>
                            <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal"
                                data-dismiss="modal">Login to Reserve</a>

                            <?php } ?>
                        </form>
                    </div>
                </aside>
                <!--/Side-Bar-->
            </div>

            <div class="space-20"></div>
            <div class="divider"></div>

            <!--Similar-Cars-->
            <div class="similar_cars">
                <h3>Similar Rooms</h3>
                <div class="row">
                    <?php
                            $bid = $_SESSION['brndid'];
                            $sql = "SELECT tblrooms.VehiclesTitle,tblapartments.FromDate,tblrooms.PricePerDay,tblrooms.FuelType,tblrooms.ModelYear,tblrooms.id,tblrooms.SeatingCapacity,tblrooms.VehiclesOverview,tblrooms.Vimage1 from tblrooms join tblapartments on tblapartments.id=tblrooms.VehiclesBrand where tblrooms.VehiclesBrand=:bid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':bid', $bid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) { ?>
                    <div class="col-md-3 grid_listing">
                        <div class="product-listing-m gray-bg">
                            <div class="product-listing-img"> <a
                                    href="room-details.php?vhid=<?php echo htmlentities($result->id); ?>"><img
                                        src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>"
                                        class="img-responsive" alt="image" /> </a>
                            </div>
                            <div class="product-listing-content">
                                <h5><a href="room-details.php?vhid=<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->FromDate); ?>
                                        , <?php echo htmlentities($result->VehiclesTitle); ?></a></h5>
                                <p class="list-price">$<?php echo htmlentities($result->PricePerDay); ?></p>

                                <ul class="features_list">

                                    <li><i class="fa fa-user"
                                            aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity); ?>
                                        seats</li>
                                    <li><i class="fa fa-calendar"
                                            aria-hidden="true"></i><?php echo htmlentities($result->ModelYear); ?> model
                                    </li>
                                    <li><i class="fa fa-car"
                                            aria-hidden="true"></i><?php echo htmlentities($result->FuelType); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php }
                            } ?>

                </div>
            </div>
            <!--/Similar-Cars-->

        </div>
    </section>
    <!--/Listing-detail-->

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


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/interface.js"></script>
    <script src="assets/js/bootstrap-slider.min.js"></script>
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