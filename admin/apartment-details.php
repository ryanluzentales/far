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
 		$status = "2";
		$sql = "UPDATE tblapartments SET Status=:status WHERE  id=:eid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $status, PDO::PARAM_STR);
		$query->bindParam(':eid', $eid, PDO::PARAM_STR);
		$query->execute();
		echo "<script>alert('Booking Successfully Cancelled');</script>";
		echo "<script type='text/javascript'> document.location = 'canceled-apartment.php; </script>";

	}if(isset($_REQUEST['eid'])){
		$email = 'jrobertosy@gmail.com';
    	$subject = "APARTMENT DENIED";
    	$message = "Good day owner! your request has been reviews and unfortunately it has been denied and will be reviewed further. If you have any questions please feel free to contact us. Thank you for using FAR app";
		
   	 	$mail = new PHPMailer(true);             
   	 	try {
        //Server settingss
        	$mail->isSMTP();                                     
        	$mail->Host = 'mail.smtp2go.com';                      
        	$mail->SMTPAuth = true;                             
        	$mail->Username = 'emailsupport@findaroom.app';     
       		$mail->Password = 'Find4room!';             
       	 	$mail->SMTPOptions = array(
            	'ssl' => array(
            	'verify_peer' => false,
            	'verify_peer_name' => false,
            	'allow_self_signed' => true
            	)
        );                         
        $mail->SMTPSecure = 'none';                           
        $mail->Port = 2525;                                   

        //Send Email
        $mail->setFrom('emailsupport@findaroom.com');
        
        //Recipients
        $mail->addAddress($email);              
        $mail->addReplyTo($email);
        
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
		
       $_SESSION['result'] = 'Message has been sent';
	   $_SESSION['status'] = 'ok';
    } catch (Exception $e) {
	   $_SESSION['result'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
	   $_SESSION['status'] = 'error';
    }
	}


	if (isset($_REQUEST['aeid'])) {
		$aeid = intval($_GET['aeid']);
		$status = 1;
		$name = $_GET['FromDate'];
		$address = $_GET['ToDate'];
		$sql = "UPDATE tblapartments SET Status=:status WHERE  id=:aeid; INSERT INTO tblapartments(FromDate,address) VALUES(:name,:address)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $status, PDO::PARAM_STR);
		$query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
		$query->bindParam(':name', $name, PDO::PARAM_STR);
		$query->bindParam(':address', $address, PDO::PARAM_STR);
		$query->execute();
		echo '<script type="text/javascript">alert("Apartment confirmed");</script>';
		echo "<script type='text/javascript'> document.location = 'confirmed-apartment.php'; </script>";

	} if(isset($_REQUEST['aeid'])){
		$email = 'jrobertosy@gmail.com';
    	$subject = "APARTMENT APPROVED";
    	$message = "Good day owner! your request has been reviewed and is now accepted, your apartment will now be posted. Thank you for using FAR app.";
		
   	 	$mail = new PHPMailer(true);             
   	 	try {
        //Server settingss
        	$mail->isSMTP();                                     
        	$mail->Host = 'mail.smtp2go.com';                      
        	$mail->SMTPAuth = true;                             
        	$mail->Username = 'emailsupport@findaroom.app';     
       		$mail->Password = 'Find4room!';             
       	 	$mail->SMTPOptions = array(
            	'ssl' => array(
            	'verify_peer' => false,
            	'verify_peer_name' => false,
            	'allow_self_signed' => true
            	)
        );                         
        $mail->SMTPSecure = 'none';                           
        $mail->Port = 2525;                                   

        //Send Email
        $mail->setFrom('emailsupport@findaroom.app');
        
        //Recipients
        $mail->addAddress($email);              
        $mail->addReplyTo($email);
        
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
		
       $_SESSION['result'] = 'Message has been sent';
	   $_SESSION['status'] = 'ok';
    } catch (Exception $e) {
	   $_SESSION['result'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
	   $_SESSION['status'] = 'error';
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
												$sql = "SELECT tblowner.*,tblapartments.FromDate, tblapartments.ToDate, tblapartments.message, tblapartments.Status, tblapartments.PostingDate, tblapartments.id, tblapartments.BookingNumber from tblapartments join verify on verify.BookingNumber=tblapartments.BookingNumber join tblowner on tblowner.EmailId=tblapartments.userEmail where tblapartments.id=:bid";
												$query = $dbh->prepare($sql);
												$query->bindParam(':bid', $bid, PDO::PARAM_STR);
												$query->execute();
												$results = $query->fetchAll(PDO::FETCH_OBJ);
												$cnt = 1;
												if ($query->rowCount() > 0) {
													foreach ($results as $result) {				?>
                                            <h3 style="text-align:center; color:red">
                                                #<?php echo htmlentities($result->BookingNumber); ?> Apartment Details
                                            </h3>

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
                                                <td><?php echo htmlentities($result->FromDate); ?></td>

                                            </tr>
                                            <tr>

                                                <th>Address</th>
                                                <td><?php echo htmlentities($result->ToDate); ?></td>
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

                                            <?php if ($result->Status == 0) { ?>
                                            <tr>
                                                <td style="text-align:center" colspan="4">
                                                    <a href="apartment-details.php?aeid=<?php echo htmlentities($result->id); ?>"
                                                        onclick="return confirm('Confirm and send email notification')"
                                                        class="btn btn-primary"> Approve</a>

                                                    <a href="apartment-details.php?eid=<?php echo htmlentities($result->id); ?>"
                                                        onclick="return confirm('Deny and send email notification')"
                                                        class="btn btn-danger"> Deny</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php $cnt = $cnt + 1;
													}
												} ?>

                                        </tbody>
                                    </table>
                                    <form method="post">
                                        <input name="Submit2" type="submit" class="txtbox4" value="Print"
                                            onClick="return f3();" style="cursor: pointer;" />
                                    </form>

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