<?php
session_start();
if(!isset($_SESSION['remlogin'])){
	header("Location:login");
}
else{
	$userId = $_SESSION['remlogin'];
	include('database.php');
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
    <link rel="stylesheet" href="wrapstyle.css">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- custom css file link  -->
	
	<link href="assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
	.home {margin-top:-70px}
	.header-1 img{width:30%;}
	table{width:100%;border:1px solid #ccc;}
	tr:nth-child(1){border:1px solid #ccc;}
	th,td{padding:1%;font-size:15px;}
	a{text-decoration:none;color:#fe2121;}
	.copyright{position:fixed;bottom:20px;right:10px;border:1px solid #ccc;padding:0.5%;z-index: 2;}
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
        <img src = 'logo1.png' title = logo></a></center>
        <a href="processing?logoutId=1" title = 'Signout' style = 'position:fixed;right:30px;color:#fe2121;font-size:20px;'>
		<b>&#10140;</b></a>
    </div>

    

</header>


<!-- Pickup section starts  -->

<section class="contact">
	<center>
		<a href = 'setReminder' title = 'Add New Reminder' class='btn' style = 'background:#fe2121;'>Add Reminder</a>
</center>

</section>

<section class="contact">
	<form>
		<table >
			<tr>
				<th>Title</th>
				<th>Category</th>
				<th>Status</th>
				<th>End Date</th>
				<th>Action</th>
			</tr>
			<?php
				$sql = "SELECT * FROM register where userid = {$userId} order by id desc";
				$result = $conn->query($sql);
				if ($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$id = $row['id'];
						$title = $row['title'];
						$status = $row['status'];
						$category = $row['category'];
						$edate = $row['edate'];
						if ($status != 'Corrected'){
							$status = "<b><font style = 'color:#E62E2D;'>Not yet Corrected</font></b>";
							$action = "<a href = 'processing?correctionId={$id}'><i class='fa fa-check' aria-hidden='true'></i> Correct</a>";
						}
						else{
							$status = "<b><font style = 'color:#0f0;'>{$status}</font></b>";
							$action = "<a href = 'processing?recorrectionId={$id}'><i class='fa fa-check' aria-hidden='true'></i> Reset</a>";
						}
						echo "<tr><td><a href = 'reminderDetails?viewId={$id}'>{$title}</a></td><td>{$category}</td><td>{$status}</td><td>{$edate}</td><td>{$action} | <a href = ''> <b>&#x1F589</b> Edit</a> | <a href = 'processing?delId={$id}'><i class='fa fa-trash' aria-hidden='true'></i> Delete</a></td></tr>";
					}
				}
			?>
		</table>
    </form>
	<div class="wrapper">
      <div class="content">
        <ul class="menu">
          <li class="item share">
            <ul class="share-menu"></ul>
          </li>
          <li class="item">
            <i class="uil uil-ban"></i>
          </li>
          <li class="item">
            <span>Right Click Disabled</span>
          </li>
        </ul>
      </div>
    </div>
</section>
<div class="copyright"><h5>Developed by<br>Thisula Development<h5></div>
<!-- Pickup section ends -->
<br><br>
<!-- custom js file link  -->
<script src = "scripts.js">
</script>
</body>
</html>