<?php 
include('connection.php');


function showComments()
{
	$comment="";
	
	$comment.=commenttree();
	
	echo $comment;
}

function commenttree($parentid=NULL)
{
	$comments='';
	$sql='';
	
	
	if(is_null($parentid))
	{
	$sql="select * from comments where comment_id='0'";
	}
	
	else 
	{
		$sql="select * from comments where comment_id=$parentid";
	}
	
	
	$result=mysqli_query($GLOBALS['conn'],$sql);
	
	while($data=mysqli_fetch_array($result))
	{
	
		
		if($data['comment_id']=='0')
		{
		 $comments.='
		 <div class="media border comment0 p-3">
    <div class="media-body">
      <h4>'.$data['name'].'<small><i> Posted on February 19, 2016</i></small></h4>
     
	 '.$data['description'].'
      
	  <p><a href="#postcomment" class="btn btn-primary mt-2 float-right" onclick="reply('.$data['id'].')">reply</a></p>
	 </div>
	 </div>
	  ';
		}
		else 
		{
			$comments.='<div class="media border reply p-3">
    <div class="media-body">
      <h4>'.$data['name'].'<small><i> Posted on February 19, 2016</i></small></h4>
     
	 '.$data['description'].'
      
	  <p><a href="#postcomment" class="btn btn-primary mt-2 float-right" onclick="reply('.$data['id'].')">reply</a></p>
	  </div>
	  </div>
	  ';
		}
	  
		
			
			

        $comments.='<div class="media  parent  p-3">
    <div class="media-body">'.commenttree($data['id']).'</div></div>';

		}
	
	
	
	
	
	return $comments;

}


$blogid=$_GET['blogid'];

if(isset($_POST['submit']))
{
	
	if(empty($_POST['commentid']))
	{
		$commentid='0';
	}
	else 
	{
		$commentid=$_POST['commentid'];
	}
	
	$sql="insert into comments (blog_id,comment_id,name,description) values ('".$blogid."','".$commentid."','".$_POST['name']."','".$_POST['description']."')";
	
	$result=mysqli_query($conn,$sql);
	
	if($result)
	{
		echo '<script>alert("comment added successfully, we will published after verify your comment.")</script>';
	}
	
	else 
	{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blog Detail</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>




<h4>Comments</h4>
	<?php showComments(); ?>


<div class="col-lg-12" id="postcomment">
<h4 class="mt-4">Post Your Comment</h4>
<form method="post">
<input type="hidden" name="commentid" id="commentid">
<label>Name</label>
<input type="text" class="form-control" name="name">
<label>Comment</label>
<textarea class="form-control" name="description"></textarea>
<input type="submit" name="submit" class="btn btn-primary mt-2">
</form>

<script>
function reply(commentid)
{
	
	//alert(commentid);
	$("#commentid").val(commentid);
}
</script>

</body>
</html>
