<?php

include('includes/config.php');
if(isset($_POST["rating_data"]))
{

$data = array(
':user_name' => $_POST["user_name"],
':user_rating' => $_POST["rating_data"],
':room_id' => $_POST["room_id"],
':vhid' => $_POST["room_id"],
':user_review' => $_POST["user_review"],
':datetime' => time()
);

$query = "
INSERT INTO review_table
(room_id,user_name, user_rating, user_review, datetime)
VALUES (:room_id,:user_name, :user_rating, :user_review, :datetime); INSERT INTO verify_comment(room_id, vhid) VALUES (:room_id, :vhid)
";

$statement = $dbh->prepare($query);

$statement->execute($data);

echo "Your Review & Rating Successfully Submitted";

}


if(isset($_POST["action"]))
{

$average_rating = 0;
$total_review = 0;
$five_star_review = 0;
$four_star_review = 0;
$three_star_review = 0;
$two_star_review = 0;
$one_star_review = 0;
$total_user_rating = 0;
$review_content = array();

$query = "SELECT * FROM review_table join tblrooms on tblrooms.id = review_table.room_id where review_table.room_id = '2' ";

$result = $dbh->query($query, PDO::FETCH_ASSOC);

foreach($result as $row)
{
$review_content[] = array(
'room_id' => $row["room_id"],
'user_name' => $row["user_name"],
'user_review' => $row["user_review"],
'rating' => $row["user_rating"],
'datetime' => date('l jS, F Y h:i:s A', $row["datetime"])
);

if($row["user_rating"] == '5')
{
$five_star_review++;
}

if($row["user_rating"] == '4')
{
$four_star_review++;
}

if($row["user_rating"] == '3')
{
$three_star_review++;
}

if($row["user_rating"] == '2')
{
$two_star_review++;
}

if($row["user_rating"] == '1')
{
$one_star_review++;
}

$total_review++;

$total_user_rating = $total_user_rating + $row["user_rating"];

}

$average_rating = $total_user_rating / $total_review;

$output = array(
'average_rating' => number_format($average_rating, 1),
'total_review' => $total_review,
'five_star_review' => $five_star_review,
'four_star_review' => $four_star_review,
'three_star_review' => $three_star_review,
'two_star_review' => $two_star_review,
'one_star_review' => $one_star_review,
'review_data' => $review_content
);

echo json_encode($output);

}

?>