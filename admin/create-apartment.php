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
         echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
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
                    <h1><i aria-hidden="true"></i>Post apartment</h1>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Apartment Name:</label>
                        <input type="text" class="form-control" name="fromdate" placeholder="Apartment Name">
                    </div>
                    <div class="form-group">
                        <label>Owner Name:</label>
                        <input type="text" class="form-control" name="ownername" placeholder="Owner Name">
                    </div>

                    <div class="form-group">
                        <label>Owner Email Address:</label>
                        <input type="text" class="form-control" name="useremail" placeholder="Owner Email Address">
                    </div>

                    <div class="form-group">
                        <label> Apartment Address:</label>
                        <input type="text" class="form-control" name="todate" placeholder="Address">
                    </div>
                    <div class="form-group">
                        <label>Landmark:</label>
                        <input type="text" class="form-control" name="message" placeholder="Landmark">
                    </div>
                    <div class="form-group">
                        <label>Owner Contact Number:</label>
                        <input type="number" class="form-control" name="contactnumber" placeholder="Contact Number">
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

    <script>
    window.onload = function() {

        // Line chart from swirlData for dashReport
        var ctx = document.getElementById("dashReport").getContext("2d");
        window.myLine = new Chart(ctx).Line(swirlData, {
            responsive: true,
            scaleShowVerticalLines: false,
            scaleBeginAtZero: true,
            multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
        });

        // Pie Chart from doughutData
        var doctx = document.getElementById("chart-area3").getContext("2d");
        window.myDoughnut = new Chart(doctx).Pie(doughnutData, {
            responsive: true
        });

        // Dougnut Chart from doughnutData
        var doctx = document.getElementById("chart-area4").getContext("2d");
        window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {
            responsive: true
        });

    }
    </script>
</body>

</html>