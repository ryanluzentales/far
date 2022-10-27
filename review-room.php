<?php
session_start();
include('includes/config.php');
error_reporting(0);

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
    <script src="jquery-3.2.1.min.js"></script>



</head>

<body>


    <!--Header-->
    <?php include('includes/header.php'); ?>
    <!-- /Header -->


    <div class="comment-form-container">
        <form id="frm-comment">
            <h4 class="review-title">Review Page</h4>
            <div class="input-row">
                <div class="label-name">Name:</div><br>
                <input type="hidden" name="comment_id" id="commentId" /> <input class="input-field-name" type="text"
                    name="name" id="name" placeholder="Enter your name" />
            </div>
           
            <div class="input-row">
                <div class="label-comment">Comment:</div><br>
                <textarea class="input-field-comment" name="comment" id="comment"
                    placeholder="Your comment here"></textarea>
            </div>
        
            <div>
                <input type="button" class="comment-btn-submit" id="submitButton" value="Publish" />
            </div>
        </form>
    </div>
    <div class="display" id="output"></div>
    <script>
    function postReply(commentId) {
        $('#commentId').val(commentId);
        $("#name").focus();
    }

    $("#submitButton").click(function() {
        $("#comment-message").css('display', 'none');
        var str = $("#frm-comment").serialize();

        $.ajax({
            url: "comment-add.php",
            data: str,
            type: 'post',
            success: function(response) {
                var result = eval('(' + response + ')');
                if (response) {
                    $("#comment-message").css('display', 'inline-block');
                    $("#name").val("");
                    $("#comment").val("");
                    $("#commentId").val("");
                    listComment();
                } else {
                    alert("Failed to add comments !");
                    return false;
                }
            }
        });
    });

    $(document).ready(function() {
        listComment();
    });

    function listComment() {
        $.post("comment-list.php",
            function(data) {
                var data = JSON.parse(data);

                var comments = "";
                var replies = "";
                var item = "";
                var parent = -1;
                var results = new Array();

                var list = $("<ul class='outer-comment'>");
                var item = $("<li>").html(comments);

                for (var i = 0;
                    (i < data.length); i++) {
                    var commentId = data[i]['comment_id'];
                    parent = data[i]['parent_comment_id'];

                    if (parent == "0") {
                        comments = "<div class='comment-row'>" +
                            "<div class='comment-info'><span class='comment-row-label'></span> <span class='posted-by'>" +
                            data[i]['comment_sender_name'] +
                            " </span> <span class='comment-row-label'> at </span> <span class='posted-at'>" + data[
                                i]
                            [
                                'comment_at'
                            ] + "</span></div>" +
                            "<div class='comment-text'>" + data[i]['comment'] + "</div>" +
                            "<div><a class='btn-reply' onClick='postReply(" + commentId + ")'>Reply</a></div>" +
                            "</div>";

                        var item = $("<li>").html(comments);
                        list.append(item);
                        var reply_list = $('<ul>');
                        item.append(reply_list);
                        listReplies(commentId, data, reply_list);
                    }
                }
                $("#output").html(list);
            });
    }

    function listReplies(commentId, data, list) {
        for (var i = 0;
            (i < data.length); i++) {
            if (commentId == data[i].parent_comment_id) {
                var comments = "<div class='comment-row'>" +
                    " <div class='comment-info'><span class='comment-row-label'></span> <span class='posted-by'>" +
                    data[i]['comment_sender_name'] +
                    " </span> <span class='comment-row-label'>at</span> <span class='posted-at'>" + data[i][
                        'comment_at'
                    ] + "</span></div>" +
                    "<div class='comment-text'>" + data[i]['comment'] + "</div>" +
                    "<div><a class='btn-reply' onClick='postReply(" + data[i]['comment_id'] + ")'>Reply</a></div>" +
                    "</div>";
                var item = $("<li>").html(comments);
                var reply_list = $('<ul>');
                list.append(item);
                item.append(reply_list);
                listReplies(data[i].comment_id, data, reply_list);
            }
        }
    }
    </script>



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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/interface.js"></script>
    <script src="assets/js/bootstrap-slider.min.js"></script>
    <!--Slider-JS-->
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>

</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->

</html>