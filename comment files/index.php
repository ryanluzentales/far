<?php 
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blogs</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>All Blogs</h2>
  <p>To Comment on blog please click on view detail link.</p>            
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Sr.No</th>
        <th>Title</th>
        <th>Description</th>
		<th>View</th>
      </tr>
    </thead>
    <tbody>
	
	<?php 
	
	$sql="select * from blogs";
	$result=mysqli_query($conn,$sql);
	
	
	$i=1;
	while($data=mysqli_fetch_array($result))
	{?>
      <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $data['title'];?></td>
        <td><?php echo $data['description'];?></td>
		<td><a href="blog-detail.php?blogid=<?php echo $data['id'];?>">view detail</a></td>
      </tr>
	<?php $i++; } ?>  
    </tbody>
  </table>
</div>

</body>
</html>
