<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['ologin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['submit'])) {
		$vehicletitle = $_POST['vehicletitle'];
		$brand = $_POST['brandname'];
		$vehicleoverview = $_POST['vehicalorcview'];
		$priceperday = $_POST['priceperday'];
		$BathType = $_POST['BathType'];
		$Housingtype = $_POST['Housingtype'];
		$seatingcapacity = $_POST['seatingcapacity'];
		$airconditioner = $_POST['airconditioner'];
		$powerdoorlocks = $_POST['powerdoorlocks'];
		$antilockbrakingsys = $_POST['antilockbrakingsys'];
		$brakeassist = $_POST['brakeassist'];
		$powersteering = $_POST['powersteering'];
		$driverairbag = $_POST['driverairbag'];
		$passengerairbag = $_POST['passengerairbag'];
		$powerwindow = $_POST['powerwindow'];
		$cdplayer = $_POST['cdplayer'];
		$centrallocking = $_POST['centrallocking'];
		$crashcensor = $_POST['crashcensor'];
		$leatherseats = $_POST['leatherseats'];
		$id = intval($_GET['id']);

		$sql = "update tblrooms set Landmark=:vehicletitle,Apartmentname=:brand,Overview=:vehicleoverview,PricePerDay=:priceperday,BathType=:BathType,Housingtype=:Housingtype,SeatingCapacity=:seatingcapacity,AirConditioner=:airconditioner,PowerDoorLocks=:powerdoorlocks,AntiLockBrakingSystem=:antilockbrakingsys,BrakeAssist=:brakeassist,PowerSteering=:powersteering,DriverAirbag=:driverairbag,PassengerAirbag=:passengerairbag,PowerWindows=:powerwindow,CDPlayer=:cdplayer,CentralLocking=:centrallocking,CrashSensor=:crashcensor,LeatherSeats=:leatherseats where id=:id ";
		$query = $dbh->prepare($sql);
		$query->bindParam(':vehicletitle', $vehicletitle, PDO::PARAM_STR);
		$query->bindParam(':brand', $brand, PDO::PARAM_STR);
		$query->bindParam(':vehicleoverview', $vehicleoverview, PDO::PARAM_STR);
		$query->bindParam(':priceperday', $priceperday, PDO::PARAM_STR);
		$query->bindParam(':BathType', $BathType, PDO::PARAM_STR);
		$query->bindParam(':Housingtype', $Housingtype, PDO::PARAM_STR);
		$query->bindParam(':seatingcapacity', $seatingcapacity, PDO::PARAM_STR);
		$query->bindParam(':airconditioner', $airconditioner, PDO::PARAM_STR);
		$query->bindParam(':powerdoorlocks', $powerdoorlocks, PDO::PARAM_STR);
		$query->bindParam(':antilockbrakingsys', $antilockbrakingsys, PDO::PARAM_STR);
		$query->bindParam(':brakeassist', $brakeassist, PDO::PARAM_STR);
		$query->bindParam(':powersteering', $powersteering, PDO::PARAM_STR);
		$query->bindParam(':driverairbag', $driverairbag, PDO::PARAM_STR);
		$query->bindParam(':passengerairbag', $passengerairbag, PDO::PARAM_STR);
		$query->bindParam(':powerwindow', $powerwindow, PDO::PARAM_STR);
		$query->bindParam(':cdplayer', $cdplayer, PDO::PARAM_STR);
		$query->bindParam(':centrallocking', $centrallocking, PDO::PARAM_STR);
		$query->bindParam(':crashcensor', $crashcensor, PDO::PARAM_STR);
		$query->bindParam(':leatherseats', $leatherseats, PDO::PARAM_STR);
		$query->bindParam(':id', $id, PDO::PARAM_STR);
		$query->execute();

		$msg = "Data updated successfully";
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

    <title>Find a room | Owner Edit Room Info</title>


    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="./assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="./assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="./assets/css/owl.transitions.css" type="text/css">
    <link href="./assets/css/slick.css" rel="stylesheet">
    <link href="./assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <link href="./assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="./assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="./assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="./assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="./assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="./assets/images/favicon-icon/favicon.png">
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
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <h2 class="page-title">Edit Room</h2>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Basic Info</div>
                                    <div class="panel-body">
                                        <?php if ($msg) { ?><div class="succWrap">
                                            <strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
                                        </div><?php } ?>
                                        <?php
											$id = intval($_GET['id']);
											$sql = "SELECT tblrooms.*,tblapartments.Apartmentname,tblapartments.id as bid from tblrooms join tblapartments on tblapartments.id=tblrooms.Apartmentname where tblrooms.id=:id";
											$query = $dbh->prepare($sql);
											$query->bindParam(':id', $id, PDO::PARAM_STR);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {	?>

                                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Room Title<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="vehicletitle" class="form-control"
                                                        value="<?php echo htmlentities($result->Landmark) ?>" required>
                                                </div>
                                                <label class="col-sm-2 control-label">Apartment<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <select class="selectpicker" name="brandname" required>
                                                        <option value="<?php echo htmlentities($result->bid); ?>">
                                                            <?php echo htmlentities($bdname = $result->Apartmentname); ?>
                                                        </option>
                                                        <?php $ret = "select id,Apartmentname from tblapartments";
																	$query = $dbh->prepare($ret);
																	//$query->bindParam(':id',$id, PDO::PARAM_STR);
																	$query->execute();
																	$resultss = $query->fetchAll(PDO::FETCH_OBJ);
																	if ($query->rowCount() > 0) {
																		foreach ($resultss as $results) {
																			if ($results->Apartmentname == $bdname) {
																				continue;
																			} else {
																	?>
                                                        <option value="<?php echo htmlentities($results->id); ?>">
                                                            <?php echo htmlentities($results->Apartmentname); ?>
                                                        </option>
                                                        <?php }
																		}
																	} ?>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Room Description<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" name="vehicalorcview" rows="3"
                                                        required><?php echo htmlentities($result->Overview); ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Price Per Month(in PHP)<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="priceperday" class="form-control"
                                                        value="<?php echo htmlentities($result->PricePerDay); ?>"
                                                        required>
                                                </div>
                                                <label class="col-sm-2 control-label">Bath Type<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <select class="selectpicker" name="BathType" required>
                                                        <option value="<?php echo htmlentities($result->BathType); ?>">
                                                            <?php echo htmlentities($result->BathType); ?> </option>

                                                        <option value="Petrol">Petrol</option>
                                                        <option value="Diesel">Diesel</option>
                                                        <option value="CNG">CNG</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Housing Type<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="Housingtype" class="form-control"
                                                        value="<?php echo htmlentities($result->Housingtype); ?>"
                                                        required>
                                                </div>
                                                <label class="col-sm-2 control-label">Room Capacity<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="seatingcapacity" class="form-control"
                                                        value="<?php echo htmlentities($result->SeatingCapacity); ?>"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <h4><b>Room Images</b></h4>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    Image 1 <img
                                                        src="../admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>"
                                                        width="300" height="200" style="border:solid 1px #000">
                                                    <a
                                                        href="changeimage1.php?imgid=<?php echo htmlentities($result->id) ?>">Change
                                                        Image 1</a>
                                                </div>
                                                <div class="col-sm-4">
                                                    Image 2<img
                                                        src="../admin/img/vehicleimages/<?php echo htmlentities($result->Vimage2); ?>"
                                                        width="300" height="200" style="border:solid 1px #000">
                                                    <a
                                                        href="changeimage2.php?imgid=<?php echo htmlentities($result->id) ?>">Change
                                                        Image 2</a>
                                                </div>
                                                <div class="col-sm-4">
                                                    Image 3<img
                                                        src="../admin/img/vehicleimages/<?php echo htmlentities($result->Vimage3); ?>"
                                                        width="300" height="200" style="border:solid 1px #000">
                                                    <a
                                                        href="changeimage3.php?imgid=<?php echo htmlentities($result->id) ?>">Change
                                                        Image 3</a>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    Image 4<img
                                                        src="../admin/img/vehicleimages/<?php echo htmlentities($result->Vimage4); ?>"
                                                        width="300" height="200" style="border:solid 1px #000">
                                                    <a
                                                        href="changeimage4.php?imgid=<?php echo htmlentities($result->id) ?>">Change
                                                        Image 4</a>
                                                </div>
                                                <div class="col-sm-4">
                                                    Image 5
                                                    <?php if ($result->Vimage5 == "") {
																	echo htmlentities("File not available");
																} else { ?>
                                                    <img src="../admin/img/vehicleimages/<?php echo htmlentities($result->Vimage5); ?>"
                                                        width="300" height="200" style="border:solid 1px #000">
                                                    <a
                                                        href="changeimage5.php?imgid=<?php echo htmlentities($result->id) ?>">Change
                                                        Image 5</a>
                                                    <?php } ?>
                                                </div>

                                            </div>
                                            <div class="hr-dashed"></div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Inclusions</div>
                                    <div class="panel-body">


                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <?php if ($result->AirConditioner == 1) { ?>
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1" name="airconditioner"
                                                        checked value="1">
                                                    <label for="inlineCheckbox1"> Air Conditioner </label>
                                                </div>
                                                <?php } else { ?>
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1" name="airconditioner"
                                                        value="1">
                                                    <label for="inlineCheckbox1"> Air Conditioner </label>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php if ($result->PowerDoorLocks == 1) { ?>
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1" name="powerdoorlocks"
                                                        checked value="1">
                                                    <label for="inlineCheckbox2"> Power Door Locks </label>
                                                </div>
                                                <?php } else { ?>
                                                <div class="checkbox checkbox-success checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1" name="powerdoorlocks"
                                                        value="1">
                                                    <label for="inlineCheckbox2"> Power Door Locks </label>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php if ($result->AntiLockBrakingSystem == 1) { ?>
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1"
                                                        name="antilockbrakingsys" checked value="1">
                                                    <label for="inlineCheckbox3"> AntiLock Braking System </label>
                                                </div>
                                                <?php } else { ?>
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1"
                                                        name="antilockbrakingsys" value="1">
                                                    <label for="inlineCheckbox3"> AntiLock Braking System </label>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php if ($result->BrakeAssist == 1) {
													?>
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1" name="brakeassist"
                                                        checked value="1">
                                                    <label for="inlineCheckbox3"> Brake Assist </label>
                                                </div>
                                                <?php } else { ?>
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="inlineCheckbox1" name="brakeassist"
                                                        value="1">
                                                    <label for="inlineCheckbox3"> Brake Assist </label>
                                                </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group">
                                                <?php if ($result->PowerSteering == 1) {
													?>
                                                <div class="col-sm-3">
                                                    <div class="checkbox checkbox-inline">
                                                        <input type="checkbox" id="inlineCheckbox1" name="powersteering"
                                                            checked value="1">
                                                        <label for="inlineCheckbox1"> Power Steering </label>
                                                    </div>
                                                    <?php } else { ?>
                                                    <div class="col-sm-3">
                                                        <div class="checkbox checkbox-inline">
                                                            <input type="checkbox" id="inlineCheckbox1"
                                                                name="powersteering" value="1">
                                                            <label for="inlineCheckbox1"> Power Steering </label>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <?php if ($result->DriverAirbag == 1) {
																?>
                                                        <div class="checkbox checkbox-inline">
                                                            <input type="checkbox" id="inlineCheckbox1"
                                                                name="driverairbag" checked value="1">
                                                            <label for="inlineCheckbox2">Driver Airbag</label>
                                                        </div>
                                                        <?php } else { ?>
                                                        <div class="checkbox checkbox-inline">
                                                            <input type="checkbox" id="inlineCheckbox1"
                                                                name="driverairbag" value="1">
                                                            <label for="inlineCheckbox2">Driver Airbag</label>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <?php if ($result->DriverAirbag == 1) {
																		?>
                                                            <div class="checkbox checkbox-inline">
                                                                <input type="checkbox" id="inlineCheckbox1"
                                                                    name="passengerairbag" checked value="1">
                                                                <label for="inlineCheckbox3"> Passenger Airbag </label>
                                                            </div>
                                                            <?php } else { ?>
                                                            <div class="checkbox checkbox-inline">
                                                                <input type="checkbox" id="inlineCheckbox1"
                                                                    name="passengerairbag" value="1">
                                                                <label for="inlineCheckbox3"> Passenger Airbag </label>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <?php if ($result->PowerWindows == 1) {
																		?>
                                                            <div class="checkbox checkbox-inline">
                                                                <input type="checkbox" id="inlineCheckbox1"
                                                                    name="powerwindow" checked value="1">
                                                                <label for="inlineCheckbox3"> Power Windows </label>
                                                            </div>
                                                            <?php } else { ?>
                                                            <div class="checkbox checkbox-inline">
                                                                <input type="checkbox" id="inlineCheckbox1"
                                                                    name="powerwindow" value="1">
                                                                <label for="inlineCheckbox3"> Power Windows </label>
                                                            </div>
                                                            <?php } ?>
                                                        </div>


                                                        <div class="form-group">
                                                            <div class="col-sm-3">
                                                                <?php if ($result->CDPlayer == 1) {
																			?>
                                                                <div class="checkbox checkbox-inline">
                                                                    <input type="checkbox" id="inlineCheckbox1"
                                                                        name="cdplayer" checked value="1">
                                                                    <label for="inlineCheckbox1"> CD Player </label>
                                                                </div>
                                                                <?php } else { ?>
                                                                <div class="checkbox checkbox-inline">
                                                                    <input type="checkbox" id="inlineCheckbox1"
                                                                        name="cdplayer" value="1">
                                                                    <label for="inlineCheckbox1"> CD Player </label>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <?php if ($result->CentralLocking == 1) {
																			?>
                                                                <div class="checkbox  checkbox-inline">
                                                                    <input type="checkbox" id="inlineCheckbox1"
                                                                        name="centrallocking" checked value="1">
                                                                    <label for="inlineCheckbox2">Central Locking</label>
                                                                </div>
                                                                <?php } else { ?>
                                                                <div class="checkbox checkbox-success checkbox-inline">
                                                                    <input type="checkbox" id="inlineCheckbox1"
                                                                        name="centrallocking" value="1">
                                                                    <label for="inlineCheckbox2">Central Locking</label>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <?php if ($result->CrashSensor == 1) {
																			?>
                                                                <div class="checkbox checkbox-inline">
                                                                    <input type="checkbox" id="inlineCheckbox1"
                                                                        name="crashcensor" checked value="1">
                                                                    <label for="inlineCheckbox3"> Crash Sensor </label>
                                                                </div>
                                                                <?php } else { ?>
                                                                <div class="checkbox checkbox-inline">
                                                                    <input type="checkbox" id="inlineCheckbox1"
                                                                        name="crashcensor" value="1">
                                                                    <label for="inlineCheckbox3"> Crash Sensor </label>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <?php if ($result->CrashSensor == 1) {
																			?>
                                                                <div class="checkbox checkbox-inline">
                                                                    <input type="checkbox" id="inlineCheckbox1"
                                                                        name="leatherseats" checked value="1">
                                                                    <label for="inlineCheckbox3"> Leather Seats </label>
                                                                </div>
                                                                <?php } else { ?>
                                                                <div class="checkbox checkbox-inline">
                                                                    <input type="checkbox" id="inlineCheckbox1"
                                                                        name="leatherseats" value="1">
                                                                    <label for="inlineCheckbox3"> Leather Seats </label>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>

                                                        <?php }
													} ?>


                                                        <div class="form-group">
                                                            <div class="col-sm-8 col-sm-offset-2">

                                                                <button class="btn btn-primary" name="submit"
                                                                    type="submit" style="margin-top:4%">Save
                                                                    changes</button>
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
                    <script src="js/bootstrap-select.min.js"></script>
                    <script src="js/bootstrap.min.js"></script>
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