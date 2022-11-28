<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['ologin']) == 0) {
	header('location:index.php');
} else {

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

    <title>FAR | New Bookings </title>

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
    <!-- Admin Stye -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
    .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    }

    .succWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    }
    </style>

</head>

<body>
    <?php include('includes/header.php'); ?>

    <div class="ts-main-content">
        <?php include('includes/leftbar.php'); ?>
        <div class="content-wrapper">


            <h2>New Booking</h2>
            <p>This is where you can see the New Bookings.</p>
            <div>
                <br>
                <div class="tab">
                    <button class="tablinks" onclick="openCity(event, 'London')">New</button>
                    <button class="tablinks" onclick="openCity(event, 'Paris')">Booked</button>

                </div>

                <!-- Tab content -->

                <div id="London" class="tabcontent">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">

                                <h2 class="page-title">New Bookings</h2>

                                <!-- Zero Configuration Table -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">Bookings Info</div>
                                    <div class="panel-body">

                                        <table id="zctb" class="display table table-striped table-bordered table-hover"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Booking No.</th>
                                                    <th>Room</th>
                                                    <th>Date</th>

                                                    <th>Status</th>
                                                    <th>Posting date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Booking No.</th>
                                                    <th>Room</th>
                                                    <th>Date</th>

                                                    <th>Status</th>
                                                    <th>Posting date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>

                                                <?php
											$status = 0;
											$sql = "SELECT tblusers.FullName,tblapartments.Apartmentname,tblrooms.Landmark,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.VehicleId as vid,tblbooking.Status,tblbooking.PostingDate,tblbooking.id,tblbooking.BookingNumber  from tblbooking join tblrooms on tblrooms.id=tblbooking.VehicleId join tblusers on tblusers.EmailId=tblbooking.userEmail join tblapartments on tblrooms.Apartmentname=tblapartments.id where tblbooking.Status=:status";
											$query = $dbh->prepare($sql);
											$query->bindParam(':status', $status, PDO::PARAM_STR);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt); ?></td>
                                                    <td><?php echo htmlentities($result->FullName); ?></td>
                                                    <td><?php echo htmlentities($result->BookingNumber); ?></td>
                                                    <td><a
                                                            href="edit-room.php?id=<?php echo htmlentities($result->vid); ?>"><?php echo htmlentities($result->Apartmentname); ?>
                                                            , <?php echo htmlentities($result->Landmark); ?></td>
                                                    <td><?php echo htmlentities($result->FromDate); ?></td>

                                                    <td><?php
															if ($result->Status == 0) {
																echo htmlentities('Not Confirmed yet');
															} else if ($result->Status == 1) {
																echo htmlentities('Confirmed');
															} else {
																echo htmlentities('Cancelled');
															}
															?></td>
                                                    <td><?php echo htmlentities($result->PostingDate); ?></td>
                                                    <td>


                                                        <a
                                                            href="bookig-details.php?bid=<?php echo htmlentities($result->id); ?>">
                                                            View</a>
                                                    </td>

                                                </tr>
                                                <?php $cnt = $cnt + 1;
												}
											} ?>

                                            </tbody>
                                        </table>



                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>

                <div id="Paris" class="tabcontent">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">

                                <h2 class="page-title">Manage Bookings</h2>

                                <!-- Zero Configuration Table -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">Bookings Info</div>
                                    <div class="panel-body">
                                        <?php if($error){?><div class="errorWrap">
                                            <strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                                        </div><?php } 
				            else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
                                        <?php }?>
                                        <table id="zctb" class="display table table-striped table-bordered table-hover"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Apartment Name</th>
                                                    <th>Reservation Date</th>

                                                    <th>Message</th>
                                                    <th>Status</th>
                                                    <th>Posting date</th>

                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Apartment Name</th>
                                                    <th>Reservation Date</th>

                                                    <th>Message</th>
                                                    <th>Status</th>
                                                    <th>Posting date</th>

                                                </tr>
                                            </tfoot>
                                            <tbody>

                                                <?php $sql = "SELECT tblusers.FullName,tblapartments.Apartmentname,tblrooms.Landmark,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.VehicleId as vid,tblbooking.Status,tblbooking.Commissionstatus,tblbooking.PostingDate,tblbooking.id  from tblbooking join tblrooms on tblrooms.id=tblbooking.VehicleId join tblusers on tblusers.EmailId=tblbooking.userEmail join tblapartments on tblrooms.Apartmentname=tblapartments.id WHERE tblbooking.Commissionstatus='1' AND tblbooking.Status='1'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt);?></td>
                                                    <td><?php echo htmlentities($result->FullName);?></td>
                                                    <td><?php echo htmlentities($result->Apartmentname);?>

                                                    <td><?php echo htmlentities($result->FromDate);?></td>

                                                    <td><?php echo htmlentities($result->message);?></td>
                                                    <td><?php 
if($result->Status==0)
{
echo htmlentities('Not Confirmed yet');
} else if ($result->Status==1) {
echo htmlentities('Confirmed');
}
 else{
 	echo htmlentities('Cancelled');
 }
										?></td>
                                                    <td><?php echo htmlentities($result->PostingDate);?></td>

                                                </tr>
                                                <?php $cnt=$cnt+1; }} ?>

                                            </tbody>
                                        </table>



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

    <script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    </script>

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


    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/interface.js"></script>
    <script src="assets/js/bootstrap-slider.min.js"></script>
    <!--Slider-JS-->
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
</body>

</html>
<?php } ?>