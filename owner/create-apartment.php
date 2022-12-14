<?php
session_start();
include('includes/config.php');
//error_reporting(0);
if (isset($_POST['submit'])) {
    $apartmentname = $_POST['apartmentname'];
    $address = $_POST['address'];
    $Landmark = $_POST['Landmark'];
    $ownername = $_POST['ownername'];
    $contactnumber = $_POST['contactnumber'];
    $housingtype = $_POST['housingtype'];
    $gender = $_POST['gender'];
    $termsofpayment = $_POST['termsofpayment'];
    $useremail = $_SESSION['ologin'];
    $referencenumber = $_POST['referencenumber'];
    $status = 0;
    $paymentreceipt = $_FILES["payment"]["name"];
    $apartmentimage = $_FILES["apartmentimage"]["name"];
    $businesspermit = $_FILES["businesspermit"]["name"];
    $governmentid = $_FILES["governmentid"]["name"];
    $bookingno = mt_rand(100000000, 999999999);
    move_uploaded_file($_FILES["payment"]["tmp_name"], "../admin/img/payment/" . $_FILES["payment"]["name"]);
    move_uploaded_file($_FILES["apartmentimage"]["tmp_name"], "../admin/img/apartmentimages/" . $_FILES["apartmentimage"]["name"]);
    move_uploaded_file($_FILES["businesspermit"]["tmp_name"], "../admin/img/businesspermit/" . $_FILES["businesspermit"]["name"]);
    move_uploaded_file($_FILES["governmentid"]["tmp_name"], "../admin/img/governmentid/" . $_FILES["governmentid"]["name"]);

    $sql = "INSERT INTO tblapartments(BookingNumber,OwnerName,userEmail,Apartmentname,Address,Landmark,Governmentid,Businesspermit,Referencenumber,Termsofpayment,ContactNumber,HousingType,ApartmentImage,gender,Payment,Status) VALUES(:bookingno,:ownername,:useremail,:apartmentname,:address,:Landmark,:governmentid,:businesspermit,:referencenumber,:termsofpayment,:contactnumber,:housingtype,:apartmentimage,:gender,:paymentreceipt,:status); INSERT INTO verify(BookingNumber) VALUES(:bookingno)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':bookingno', $bookingno, PDO::PARAM_STR);
    $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
    $query->bindParam(':ownername', $ownername, PDO::PARAM_STR);
    $query->bindParam(':gender', $gender, PDO::PARAM_STR);
    $query->bindParam(':referencenumber', $referencenumber, PDO::PARAM_STR);
    $query->bindParam(':governmentid', $governmentid, PDO::PARAM_STR);
    $query->bindParam(':businesspermit', $businesspermit, PDO::PARAM_STR);
    $query->bindParam(':termsofpayment', $termsofpayment, PDO::PARAM_STR);
    $query->bindParam(':contactnumber', $contactnumber, PDO::PARAM_STR);
    $query->bindParam(':housingtype', $housingtype, PDO::PARAM_STR);
    $query->bindParam(':apartmentimage', $apartmentimage, PDO::PARAM_STR);
    $query->bindParam(':paymentreceipt', $paymentreceipt, PDO::PARAM_STR);
    $query->bindParam(':apartmentname', $apartmentname, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);
    $query->bindParam(':Landmark', $Landmark, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('Apartment successfully created!');</script>";
    echo "<script type='text/javascript'> document.location = 'create-apartment.php'; </script>";
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "<script>alert('Booking successfull.');</script>";
        echo "<script type='text/javascript'> document.location = 'pending-apartment.php'; </script>";
    } else {
         echo "<script>alert('Something went wrong. Please try again');</script>";
         echo "<script type='text/javascript'> document.location = 'room-listing.php'; </script>";
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

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>

    <script type="text/javascript"
        src="https://rawgit.com/Logicify/jquery-locationpicker-plugin/master/dist/locationpicker.jquery.js"></script>
    <script src="maplocation.js"></script>

</head>

<body>
    <!--Header-->
    <?php include('includes/header.php'); 
    ?>
    <!-- /Header -->
    <?php
                                $email = $_SESSION['ologin'];   
                                $sql = "SELECT FullName,ContactNo FROM tblowner WHERE EmailId=:email ";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':email', $email, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                    }
                                } ?>
    <div class="ts-main-content">
        <?php include('includes/leftbar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">


            <div class="row">
                <div class="col-md-9">
                </div>
                <!--Side-Bar-->
                <aside class="col-md-12">
                    <div class="sidebar_widget">
                        <div class="widget_heading">
                            <h5><i aria-hidden="true"></i>Post apartment</h5>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Apartment Name*:</label>
                                <input type="text" class="form-control" name="apartmentname"
                                    placeholder="Apartment Name" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="ownername"
                                    value="<?php echo (isset($result->FullName))?$result->FullName:'';?>"
                                    placeholder="Owner Name">
                            </div>

                            <div class="form-group">
                                <label>Address*:</label>
                                <input type="text" class="form-control" id="location" name="address"
                                    placeholder="Location" required>
                            </div>

                            <div class="form-group">

                                <input type="hidden" class="form-control" id="lat" name="lat" placeholder="Latitude">
                            </div>
                            <div class="form-group">

                                <input type="hidden" class="form-control" id="lng" name="lat" placeholder="Longitude">
                            </div>
                            <div id="us2" style="width: 1650px; height: 400px;">
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Landmark*:</label>
                                <input type="text" class="form-control" name="Landmark" placeholder="Landmark" required>
                            </div>
                            <div class="form-group">
                                <label>Contact Number*:</label>
                                <input type="text" class="form-control" name="contactnumber"
                                    value="<?php echo (isset($result->ContactNo))?$result->ContactNo:'';?>"
                                    placeholder="Contact Number">
                            </div>
                            <div class="form-group">
                                <label>Housing Type*:</label> <br>
                                <select class="selectpicker" name="housingtype" required>
                                    <option value=""> Select </option>
                                    <option value="Apartment">Apartment</option>
                                    <option value="Dormitory">Dormitory</option>
                                    <option value="Boarding House">Boarding House</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Terms of payment*: </label> <br>
                                <select class="selectpicker" name="termsofpayment" required>
                                    <option value=""> Select </option>
                                    <option value="1 month deposit 1 month advance">1 month deposit, 1 month advance
                                    </option>
                                    <option value="1 month deposit 2 months advance">1 month deposit, 1 month advance
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Please upload an image of your Apartment*</label>
                                <input type="file" class="form-control" name="apartmentimage"
                                    placeholder="Apartment Image" required>
                                <hr>
                            </div>
                            <h3>Upload Important Files</h3>
                            <div class="form-group">
                                <label>Government Id*</label>
                                <input type="file" class="form-control" name="governmentid" placeholder="Government Id"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Business Permit*</label>
                                <input type="file" class="form-control" name="businesspermit"
                                    placeholder="Business Permit" required>
                            </div>

                            <hr>
                            <div class="form-group">
                                <label>Gender allowed*:</label> <br>
                                <select class="selectpicker" name="gender" required>
                                    <option value=""> Select </option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Mixed">Mixed</option>
                                </select>
                            </div>
                            <div>
                                <p>For payment you may use the details below:</p>
                                <p>BPI: 1243-3540-1231</p>
                                <p>Union Bank: 124-3540-1231</p>
                                <p>Gcash: 09208262854</p>

                            </div>
                            <?php
                                
                                $sql = "SELECT qr FROM changepayment";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                    }
                                } ?>
                            <p>You can also pay through GCASH using the number above or QR code below.</p>
                            <img src="assets/imagess/<?php echo htmlentities($result->qr); ?>" alt="QR Code" width="250"
                                height="250">

                            <p>For the post to be confirm, we need to check the proof of payment and other details.
                                Please upload your
                                proof of payment below:
                            </p>

                            <div class="form-group">
                                <label>Proof of Payment*</label>
                                <input type="file" class="form-control" name="payment" placeholder="Proof of Payment"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Reference Number*:</label>
                                <input type="text" class="form-control" name="referencenumber"
                                    placeholder="Reference Number" required>
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

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    <!--<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&libraries=places"></script> -->

    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB67jIHZHodP972T_z4ruJndmM9qxKfEr8&libraries=geocode,places&callback=initMap">
    </script>

    <script type="text/javascript"
        src="https://rawgit.com/Logicify/jquery-locationpicker-plugin/master/dist/locationpicker.jquery.js"></script>
    <script src="maplocation.js"></script>

</body>

</html>