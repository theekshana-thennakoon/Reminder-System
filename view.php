<?php
session_start();
if(!isset($_SESSION['remlogin'])){
	header("Location:login");
}
if(!isset($_GET['viewId'])){
	header("Location:main");
}
else{
	$viewId = $_GET['viewId'];
	include('database.php');
    date_default_timezone_set('Asia/Colombo');
    $fromdate = date("Y-m-d");
    $fromdate = strtotime("{$fromdate}");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--<link rel="icon" href="https://th.bing.com/th/id/R.c70638d537870aec2fdae3699a22c1df?rik=N76Nn3vS2F3PeQ&riu=http%3a%2f%2fwww.lanmds.com%2fwp-content%2fuploads%2f2016%2f03%2fPress-Release-image-1.jpg&ehk=Vq46veuwxCiHGJYg%2fg3qHHgR%2f%2b%2fDyENwzMaKaydjS0o%3d&risl=&pid=ImgRaw&r=0">
-->
	<title>Reminder</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="fontawasome.css">

    <!-- custom css file link  -->
	
	<link href="assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
	.home {margin-top:-70px}
	.header-1 img{width:30%;}
	table{width:100%;border:1px solid #ccc;}
	th{border-right:1px solid #ccc;}
	th,td{padding:1%;font-size:15px;border-bottom:1px solid #ccc;text-align:left;}
	a{text-decoration:none;color:#fe2121;}
  @media (max-width: 739px) {
	.header-1 img{width:80%;}
  } 
    </style>
</head>
<body>
<script src="sweetalert.min.js"></script>

<!-- header section starts  -->

<header>

    <div class="header-1">

	<center><a href="#" class="logo" style = 'color:#fe2121;'>
        <img src = 'logo1.png'></a></center>
    </div>

    

</header>


<!-- Pickup section starts  -->

<section class="contact"></section>

<section class="contact">
	<form>
		<table >
			<?php
				$sql = "SELECT * FROM register where id = {$viewId}";
				$result = $conn->query($sql);
				if ($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$id = $row['id'];
						$title = $row['title'];
						$description = $row['description'];
						$status = $row['status'];
						$category = $row['category'];
						$edate = $row['edate'];
						if ($status != 'Corrected'){
							$status = "<b><font style = 'color:#E62E2D;'>Not yet Corrected</font></b>";
							$todate = strtotime("{$edate}");
                            $diff_days = $todate - $fromdate;
			                $different = floor($diff_days/(60*60*24));
                            $remainingStates = $different . " Days Remaining";
                            $action = "<a href = 'processing?correctionId={$id}'><i class='fa fa-check' aria-hidden='true'></i> Correct</a>";
						}
						else{
							$status = "<b><font style = 'color:#0f0;'>{$status}</font></b>";
							$remainingStates = $status;
                            $action = "<a href = 'processing?recorrectionId={$id}'><i class='fa fa-check' aria-hidden='true'></i> Reset</a>";
						}
						echo "<tr><th>Title</th><td>{$title}</td></tr>
                        <tr><th>Description</th><td>{$description}</td><tr>
                        <tr><th>Category</th><td>{$category}</td><tr>
                        <tr><th>Status</th><td>{$status}</td></tr>
                        <tr><th>End Date</th><td>{$edate}</td></tr>
                        <tr><th>Date Remaining</th><td>{$remainingStates}</td></tr>
                        <tr><th>Action</th><td>{$action} | <a href = ''> <b>&#x1F589</b> Edit</a> | <a href = 'processing?delId={$id}'><i class='fa fa-trash' aria-hidden='true'></i> Delete</a></td></tr>";

					}
				}
			?>
		</table>
    </form>
	
</section>

<!-- Pickup section ends -->
<br><br>
<!-- custom js file link  -->
<script src="script.js"></script>
    
</body>
</html>