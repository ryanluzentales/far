<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    include_once 'controllers/Comment.php';
    $com = new Comment();
    ?>

    <div>
        <ul>
            <?php
            $result = $com->index();
            while ($data = $result->fetch_assoc()) {
            ?>
                <li><b><?php echo $data['name']; ?><b> - <?php echo $com->dateFormat($data['comment_time']); ?> <br>
                            <h3><?php echo $data['comment'] ?></h3>
                </li>
            <?php } ?>
        </ul>
    </div>

    <?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo "<span style='color:green;font-size:20px'>" . $msg . "</span>";
    }
    ?>

    <form action="post_comment.php" method="post"><br><br><br>
        <p>
            Your Name:
        </p>
        <input style="width: 221px;height: 30px;" type="" name="name" placeholder="Please enter your name"></td>

        <p>Comment:
        </p>
        <textarea name="comment" rows="5" cols="30" placeholder="Please enter your comment"></textarea> <br>
        <input style="width: 230px;height: 40px;" type="submit" name="submit" value="Post"></td>
    </form>

</body>

</html>