<?php
session_start();
include('includes/config.php');
//error_reporting(0);
if (isset($_POST['submit'])) {
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];
    $message = $_POST['message'];
    $ownername = $_POST['ownername'];
    $contactnumber = $_POST['contactnumber'];
    $housingtype = $_POST['housingtype'];
    $gender = $_POST['gender'];
    $useremail = $_POST['useremail'];
    $status = 0;
    $paymentreceipt = $_FILES["payment"]["name"];
    $apartmentimage = $_FILES["apartmentimage"]["name"];
    $bookingno = mt_rand(100000000, 999999999);
    move_uploaded_file($_FILES["apartmentimage"]["tmp_name"], "admin/img/apartmentimages/" . $_FILES["apartmentimage"]["name"]);

    $sql = "INSERT INTO tblapartments(BookingNumber,OwnerName,userEmail,VehicleId,FromDate,ToDate,message,ContactNumber,HousingType,ApartmentImage,gender,Payment,Status) VALUES(:bookingno,:ownername,:useremail,:bookingno,:fromdate,:todate,:message,:contactnumber,:housingtype,:apartmentimage,:gender,:paymentreceipt,:status); INSERT INTO verify(BookingNumber) VALUES(:bookingno)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':bookingno', $bookingno, PDO::PARAM_STR);
    $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
    $query->bindParam(':ownername', $ownername, PDO::PARAM_STR);
    $query->bindParam(':gender', $gender, PDO::PARAM_STR);
    $query->bindParam(':contactnumber', $contactnumber, PDO::PARAM_STR);
    $query->bindParam(':housingtype', $housingtype, PDO::PARAM_STR);
    $query->bindParam(':apartmentimage', $apartmentimage, PDO::PARAM_STR);
    $query->bindParam(':paymentreceipt', $paymentreceipt, PDO::PARAM_STR);
    $query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
    $query->bindParam(':todate', $todate, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "<script>alert('Booking successfull.');</script>";
        echo "<script type='text/javascript'> document.location = 'manage-apartment.php'; </script>";
    } else {
         echo "<script>alert('Something went wrong. Please try again');</script>";
         echo "<script type='text/javascript'> document.location = 'room-listing.php'; </script>";
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

    <title>FAR | Admin Dashboard</title>

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
</head>

<body>
    <?php include('includes/header.php');?>

    <div class="ts-main-content">
        <?php include('includes/leftbar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="widget_heading">
                    <h5><i aria-hidden="true"></i>Post apartment</h5>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Apartment Name:</label>
                        <input type="text" class="form-control" name="fromdate" placeholder="Apartment Name">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="ownername"
                            value="<?php echo (isset($result->FullName))?$result->FullName:'';?>"
                            placeholder="Owner Name">
                    </div>

                    <div class="form-group">
                        <label>Address:</label>
                        <input type="text" class="form-control" id="location" name="todate" placeholder="Location">
                    </div>

                    <div class="form-group">

                        <input type="hidden" class="form-control" id="lat" name="lat" placeholder="Latitude">
                    </div>
                    <div class="form-group">

                        <input type="hidden" class="form-control" id="lng" name="lat" placeholder="Longitude">
                    </div>
                    <div id="us2" style="width: 1100px; height: 400px;">
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Landmark:</label>
                        <input type="text" class="form-control" name="message" placeholder="Landmark">
                    </div>
                    <div class="form-group">
                        <label>Contact Number:</label>
                        <input type="text" class="form-control" name="contactnumber"
                            value="<?php echo (isset($result->ContactNo))?$result->ContactNo:'';?>"
                            placeholder="Contact Number">
                    </div>
                    <div class="form-group">
                        <label>Housing Type:</label> <br>
                        <select class="selectpicker" name="housingtype">
                            <option value=""> Select </option>
                            <option value="Apartment">Apartment</option>
                            <option value="Dormitory">Dormitory</option>
                            <option value="Boarding House">Boarding House</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Please upload an image of your Apartment</label>
                        <input type="file" class="form-control" name="apartmentimage" placeholder="Apartment Image">
                    </div>
                    <div class="form-group">
                        <label>Gender allowed:</label> <br>
                        <select class="selectpicker" name="gender">
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
                    <p>You can also pay through GCASH using the number above or QR code below.</p>
                    <img src="assets/imagess/download.png" alt="QR Code" width="250" height="250">

                    <p>For the post to be confirm, we need to check the proof of payment and other details.
                        Please upload your
                        proof of payment below:</p>
                    <div class="form-group">
                        <label>Proof of Payment</label>
                        <input type="file" class="form-control" name="payment" placeholder="Proof of Payment">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn" name="submit" value="Submit">
                    </div>
                </form>


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