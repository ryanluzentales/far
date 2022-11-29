<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['ologin']) == 0) {
    header('location:index.php');
} else {


     if (isset($_POST['submit'])) {
        $commission = $_POST['commission'];
        $referencenumber = $_POST['referencenumber'];
        $bookingnumber = $_POST['bookingnumber'];
        move_uploaded_file($_FILES["commission"]["tmp_name"], "./admin/img/commission/" . $_FILES["commission"]["name"]);
        $sql = "UPDATE tblbooking SET Referencenumber=:referencenumber, Commissionimage=:commission WHERE tblbooking.BookingNumber=:bookingnumber";
        $query = $dbh->prepare($sql);
        $query->bindParam(':referencenumber', $referencenumber, PDO::PARAM_STR);
        $query->bindParam(':commission', $commission, PDO::PARAM_STR);
        $query->bindParam(':bookingnumber', $bookingnumber, PDO::PARAM_STR);
        $query -> execute();
        $msg="Receipt Successfully Added";
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

    <title>Find a Room | Owner Submit receipt</title>

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
    <?php include('includes/header.php'); ?>

    <div class="ts-main-content">
        <?php include('includes/leftbar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Post a Room</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Basic Info</div>

                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <h3>Submit receipt</h3>
                                                <label class="col-sm-2 control-label">Reference Number<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" id="referencenumber" name="referencenumber"
                                                        class="form-control">
                                                </div>

                                                <div class="col-sm-4">
                                                    Insert receipt here: <span style="color:red">*</span>
                                                    <input type="file" id="commission" name="commission">
                                                </div>

                                                <br><br><br>
                                                <label class="col-sm-2 control-label">Booking Number<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" id="bookingnumber" name="bookingnumber"
                                                        class="form-control">
                                                </div>



                                                <div class="form-group" id="book-section">
                                                    <div class="col-sm-8 col-sm-offset-2">
                                                        <button class="btn btn-primary" name="submit"
                                                            type="submit">Submit</button>
                                                        <button class="btn btn-danger" type="reset">Cancel</button>

                                                    </div>
                                                </div>

                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Scripts -->
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
<?php } ?>