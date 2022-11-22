<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['submit'])) {
        $vehicletitle = $_POST['vehicletitle'];
        $brand = $_POST['brandname'];
        $vehicleoverview = $_POST['vehicalorcview'];
        $address = $_POST['address'];
        $roomname = $_POST['roomname'];
        $priceperday = $_POST['priceperday'];
        $fueltype = $_POST['fueltype'];
        $modelyear = $_POST['modelyear'];
        $seatingcapacity = $_POST['seatingcapacity'];
        $vimage1 = $_FILES["img1"]["name"];
        $vimage2 = $_FILES["img2"]["name"];
        $vimage3 = $_FILES["img3"]["name"];
        $vimage4 = $_FILES["img4"]["name"];
        $vimage5 = $_FILES["img5"]["name"];
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
        move_uploaded_file($_FILES["img1"]["tmp_name"], "../admin/img/vehicleimages/" . $_FILES["img1"]["name"]);
        move_uploaded_file($_FILES["img2"]["tmp_name"], "../admin/img/vehicleimages/" . $_FILES["img2"]["name"]);
        move_uploaded_file($_FILES["img3"]["tmp_name"], "../admin/img/vehicleimages/" . $_FILES["img3"]["name"]);
        move_uploaded_file($_FILES["img4"]["tmp_name"], "../admin/img/vehicleimages/" . $_FILES["img4"]["name"]);
        move_uploaded_file($_FILES["img5"]["tmp_name"], "../admin/img/vehicleimages/" . $_FILES["img5"]["name"]);

        $sql = "INSERT INTO tblrooms(RoomName,VehiclesTitle,VehiclesBrand,VehiclesOverview,Address,PricePerDay,FuelType,ModelYear,SeatingCapacity,Vimage1,Vimage2,Vimage3,Vimage4,Vimage5,AirConditioner,PowerDoorLocks,AntiLockBrakingSystem,BrakeAssist,PowerSteering,DriverAirbag,PassengerAirbag,PowerWindows,CDPlayer,CentralLocking,CrashSensor,LeatherSeats) VALUES(:roomname,:vehicletitle,:brand,:vehicleoverview,:address,:priceperday,:fueltype,:modelyear,:seatingcapacity,:vimage1,:vimage2,:vimage3,:vimage4,:vimage5,:airconditioner,:powerdoorlocks,:antilockbrakingsys,:brakeassist,:powersteering,:driverairbag,:passengerairbag,:powerwindow,:cdplayer,:centrallocking,:crashcensor,:leatherseats)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':vehicletitle', $vehicletitle, PDO::PARAM_STR);
        $query->bindParam(':brand', $brand, PDO::PARAM_STR);
        $query->bindParam(':roomname', $roomname, PDO::PARAM_STR);
        $query->bindParam(':vehicleoverview', $vehicleoverview, PDO::PARAM_STR);
        $query->bindParam(':priceperday', $priceperday, PDO::PARAM_STR);
        $query->bindParam(':fueltype', $fueltype, PDO::PARAM_STR);
        $query->bindParam(':modelyear', $modelyear, PDO::PARAM_STR);
        $query->bindParam(':seatingcapacity', $seatingcapacity, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':vimage1', $vimage1, PDO::PARAM_STR);
        $query->bindParam(':vimage2', $vimage2, PDO::PARAM_STR);
        $query->bindParam(':vimage3', $vimage3, PDO::PARAM_STR);
        $query->bindParam(':vimage4', $vimage4, PDO::PARAM_STR);
        $query->bindParam(':vimage5', $vimage5, PDO::PARAM_STR);
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
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = " Room posted successfully";
        } else {
            $error = "Something went wrong. Please try again";
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

    <title>FAR | Admin Post Room</title>

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
    <?php include('includes/header.php');?>
    <div class="ts-main-content">
        <?php include('includes/leftbar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <h2 class="page-title">Post a Room</h2>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Basic Info</div>
                                    <?php if ($error) { ?><div class="errorWrap">
                                        <strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                                    </div>
                                    <?php } else if ($msg) { ?><div class="succWrap">
                                        <strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
                                    </div><?php } ?>

                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Room Name<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="roomname" class="form-control">
                                                </div>
                                                <label class="col-sm-2 control-label">Select an Apartment<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <select class="selectpicker" name="brandname">
                                                        <option value=""> Select </option>
                                                        <?php
                                                            $currentEmail = $_SESSION['alogin']; 
                                                            $ret = "select tblapartments.id,tblapartments.FromDate from tblapartments where tblapartments.userEmail='".$currentEmail."' AND tblapartments.Status='1'";
                                                            $query = $dbh->prepare($ret);
                                                            //$query->bindParam(':id',$id, PDO::PARAM_STR);
                                                            $query->execute();
                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                            if ($query->rowCount() > 0) {
                                                                foreach ($results as $result) {
                                                            ?>
                                                        <option value="<?php echo htmlentities($result->id); ?>">
                                                            <?php echo htmlentities($result->FromDate); ?></option>
                                                        <?php }
                                                            } ?>

                                                    </select>
                                                </div>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <label class="col-sm-2 control-label">Apartment Address<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <select class="selectpicker" name="address">
                                                        <option value=""> Select </option>
                                                        <?php
                                                            $currentEmail = $_SESSION['alogin']; 
                                                            $rett = "select tblapartments.id,tblapartments.ToDate from tblapartments where tblapartments.userEmail='".$currentEmail."' AND tblapartments.Status='1'";
                                                            $query = $dbh->prepare($rett);
                                                            //$query->bindParam(':id',$id, PDO::PARAM_STR);
                                                            $query->execute();
                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                            if ($query->rowCount() > 0) {
                                                                foreach ($results as $result) {
                                                            ?>
                                                        <option value="<?php echo htmlentities($result->ToDate); ?>">
                                                            <?php echo htmlentities($result->ToDate); ?></option>
                                                        <?php }
                                                            } ?>

                                                    </select>
                                                </div>
                                                <label class="col-sm-2 control-label">Apartment Image<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="file" name="vehicletitle" class="form-control">
                                                </div>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <label class="col-sm-2 control-label">Landmark<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="Text" name="vehicletitle" class="form-control">
                                                </div>
                                            </div>

                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Room Description<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" name="vehicalorcview"
                                                        rows="3"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Contact Number<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="priceperday" class="form-control">
                                                </div>

                                                <label class="col-sm-2 control-label">Type of Bath<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <select class="selectpicker" name="fueltype">
                                                        <option value=""> Select </option>

                                                        <option value="Private Bath">Private Bath</option>
                                                        <option value="Shared Bath">Shared Bath</option>

                                                    </select>
                                                </div>
                                                <br>
                                                <br>
                                                <br>
                                                <label class="col-sm-2 control-label">Price Per Month (in PHP)<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="priceperday" class="form-control">
                                                </div>

                                                <label class="col-sm-2 control-label">Housing Type<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <select class="selectpicker" name="modelyear">
                                                        <option value=""> Select </option>

                                                        <option value="Private Bath">Apartment</option>
                                                        <option value="Shared Bath">Boarding House</option>
                                                        <option value="Shared Bath">Dormitory</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Room Capacity<span
                                                        style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="number" name="seatingcapacity" class="form-control">
                                                </div>
                                            </div>


                                            <div class="hr-dashed"></div>


                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <h4><b>Upload photos of the room</b></h4>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    Image 1 <span style="color:red">*</span><input type="file"
                                                        name="img1">
                                                </div>
                                                <div class="col-sm-4">
                                                    Image 2<span style="color:red">*</span><input type="file"
                                                        name="img2">
                                                </div>
                                                <div class="col-sm-4">
                                                    Image 3<span style="color:red">*</span><input type="file"
                                                        name="img3">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    Image 4<span style="color:red">*</span><input type="file"
                                                        name="img4">
                                                </div>
                                                <div class="col-sm-4">
                                                    Image 5<input type="file" name="img5">
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
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="airconditioner" name="airconditioner"
                                                        value="1">
                                                    <label for="airconditioner"> Wifi </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="powerdoorlocks" name="powerdoorlocks"
                                                        value="1">
                                                    <label for="powerdoorlocks"> AirConditioner </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="antilockbrakingsys"
                                                        name="antilockbrakingsys" value="1">
                                                    <label for="antilockbrakingsys"> Single Bed </label>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-inline">
                                                <input type="checkbox" id="brakeassist" name="brakeassist" value="1">
                                                <label for="brakeassist"> Refrigerator </label>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="powersteering" name="powersteering"
                                                        value="1">
                                                    <label for="powersteering">Television</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="driverairbag" name="driverairbag"
                                                        value="1">
                                                    <label for="driverairbag">Kitchen</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="passengerairbag" name="passengerairbag"
                                                        value="1">
                                                    <label for="passengerairbag"> Shared Bathroom </label>
                                                </div>
                                            </div>
                                            <div class="checkbox checkbox-inline">
                                                <input type="checkbox" id="powerwindow" name="powerwindow" value="1">
                                                <label for="powerwindow"> Private Bath</label>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="cdplayer" name="cdplayer" value="1">
                                                    <label for="cdplayer"> Free Eletricity</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="checkbox h checkbox-inline">
                                                    <input type="checkbox" id="centrallocking" name="centrallocking"
                                                        value="1">
                                                    <label for="centrallocking">Free Water</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="crashcensor" name="crashcensor"
                                                        value="1">
                                                    <label for="crashcensor"> Cabinet </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="checkbox checkbox-inline">
                                                    <input type="checkbox" id="leatherseats" name="" value="1">
                                                    <label for="leatherseats"> Balcony </label>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="form-group" id="book-section">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <button class="btn btn-primary" name="submit" type="submit">Save
                                                    changes</button>
                                                <button class="btn btn-default" type="reset">Cancel</button>

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
</body>

</html>
<?php } ?>