<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';


session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

    if (isset($_REQUEST['eid'])) {
		$eid = intval($_GET['eid']);
 		$status = "1";
		$sql = "UPDATE tblapartments SET Status=:status WHERE  id=:eid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $status, PDO::PARAM_STR);
		$query->bindParam(':eid', $eid, PDO::PARAM_STR);
		$query->execute();
		echo "<script>alert('Booking Successfully Approved');</script>";
		echo "<script type='text/javascript'> document.location = 'confirmed-apartment.php'; </script>";
        $email =  "jrobertosy@gmail.com";
        $subject = "Apartment Approved";
        $message = 'Good day owner! your request has been reviewed and is now accepted, your apartment will now be posted. Thank you for using FAR app.';
        $mail = new PHPMailer(true);                            

        //Server settings
        $mail->isSMTP();                                     
        $mail->Host = 'smtp-relay.sendinblue.com';                      
        $mail->SMTPAuth = true;                             
        $mail->Username = 'ryfu.luzentales@swu.phinma.edu.ph';     
        $mail->Password = 'mC6haDOrVAcfTY3G';             
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'tls';                           
        $mail->Port = 587;
        //Send Email
        $mail->setFrom('ryfu.luzentales.swu@phinmaed.com');
        
        //Recipients
        $mail->addAddress($email);              
        $mail->addReplyTo('ryfu.luzentales.swu@phinmaed.com');
        
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        $_SESSION['result'] = 'Message has been sent';
	   $_SESSION['status'] = 'ok';
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

    <title>FAR | New Apartment</title>

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

                        <h2 class="page-title">Apartment Details</h2>

                        <!-- Zero Configuration Table -->
                        <div class="panel panel-default">
                            <div class="panel-heading">Apartment Info</div>
                            <div class="panel-body">


                                <div id="print">
                                    <table border="1" class="display table table-striped table-bordered table-hover"
                                        cellspacing="0" width="100%">

                                        <tbody>

                                            <?php
												$bid = intval($_GET['bid']);
												$sql = "SELECT tblowner.*,tblapartments.Apartmentname, tblapartments.Address, tblapartments.Landmark, tblapartments.Status, tblapartments.PostingDate, tblapartments.id, tblapartments.BookingNumber from tblapartments join verify on verify.BookingNumber=tblapartments.BookingNumber join tblowner on tblowner.EmailId=tblapartments.userEmail where tblapartments.id=:bid";
												$query = $dbh->prepare($sql);
												$query->bindParam(':bid', $bid, PDO::PARAM_STR);
												$query->execute();
												$results = $query->fetchAll(PDO::FETCH_OBJ);
												$cnt = 1;
												if ($query->rowCount() > 0) {
													foreach ($results as $result) {				?>
                                            <h3 style="text-align:center; color:red">
                                                #<?php echo htmlentities($result->BookingNumber); ?> Apartment Details
                                                <?php 
                                                $email = $result->EmailId;
                                                $email = $email;
                                                
                                                ?>
                                            </h3>
                                            <div class="form-group">
                                                <input type="hidden" name="currentemail" id="currentemail"
                                                    class="form-control"
                                                    value="<?php echo (isset($result->EmailId))?$result->EmailId:'';?>" />
                                            </div>

                                            <tr>
                                                <th colspan="4" style="text-align:center;color:blue">Details</th>

                                            </tr>
                                            <tr>
                                                <th>Booking No.</th>
                                                <td>#<?php echo htmlentities($result->BookingNumber); ?></td>

                                            </tr>
                                            <tr>
                                                <th>Email Id</th>
                                                <td><?php echo htmlentities($result->EmailId); ?></td>


                                            </tr>

                                            <tr>
                                                <th>Apartment Name</th>
                                                <td><?php echo htmlentities($result->Apartmentname); ?></td>

                                            </tr>
                                            <tr>

                                                <th>Address</th>
                                                <td><?php echo htmlentities($result->Address); ?></td>
                                            </tr>


                                            <tr>
                                                <th>Apartment Status</th>
                                                <td><?php
																if ($result->Status == 0) {
																	echo htmlentities('Not Confirmed yet');
																} else if ($result->Status == 1) {
																	echo htmlentities('Confirmed');
																} else {
																	echo htmlentities('Cancelled');
																}
																?></td>

                                            </tr>



                                            <tr>
                                                <td style="text-align:center" colspan="4">
                                                    <a href="apartment-details.php?eid=<?php echo htmlentities($result->id); ?>"
                                                        onclick="return confirm('Are you sure, Do you want approve this apartment? ')"
                                                        name="approve" class="btn btn-primary"> Approve</a>


                                                    <a href="deny-apartment.php?bid=<?php echo htmlentities($result->id); ?>"
                                                        onclick="return confirm('Are you sure, Do you want to deny this apartment?')"
                                                        name="deny " class="btn btn-danger"> Deny</a>

                                                </td>
                                            </tr>

                                            <?php 
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
            <script language="javascript" type="text/javascript">
            function f3() {
                window.print();
            }
            </script>


</body>

</html>
<?php } ?>