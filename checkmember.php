<?php
session_start();
include('database.php');
if(!isset($_SESSION['AddStatusAdmin'])){
    header("Location:login");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sri Lanka Election</title>

    <!-- font awesome cdn link  -->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
-->
    <!-- custom css file link  -->
	
	<link href="assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
    .header-1 img{width:30%;}
    table{width:100%;border:1px solid #000;}
    th{text-align:center;}

    th:nth-child(1) {width:20%;}
    th:nth-child(2) {width:40%;}

    th,td{padding:1%;border:1px solid #000;font-size:14px;}
    .addorapprove{text-decoration:none;color:#fff;background:#f00;padding:6% 20%;}
    .addorapprove:hover{color:#fff;background:#0f0;}
    border-radius:5px;font-size:14px;}
    @media (max-width: 739px) {
        .contact{
            display: flex;min-height: 80%;align-items: center;justify-content: center;
        }
	    .header-1 img{width:80%;}
	    .inputBox .selectplant{width:100%}
    } 
    </style>
</head>
<body>
<script src="sweetalert.min.js"></script>

<!-- header section starts  -->

<header>

    <div class="header-1">

        <center><a href="#" class="logo" style = 'color:#fe2121;'>
        <img src = 'logo.png'></a>

    </div>

    

</header>
<!-- Pickup section starts  -->

<section class="contact">
    <?php
        $sqlc = "SELECT count(id) as cid FROM register where status = ''";
        $resultc = $conn->query($sqlc);
        if ($resultc->num_rows > 0){
            while($rowc = $resultc->fetch_assoc()){
                $cid = $rowc['cid'];
            }
        }
    ?>
    <h2><?php echo $cid ?> Voters have for get an Action </h2>
	<table>
        <tr>
            <th>NIC</th>
            <th>Name</th>
            <th>District</th>
            <th>Status</th>
        </tr>

        <?php
            $sql = "SELECT * FROM register where status = '' limit 8";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                $tds = "";
                while($row = $result->fetch_assoc()){
                    $mid = $row['id'];
                    $nic = $row['nic'];
                    $fname = $row['fname'];
                    $district = $row['district'];
                    $mid += 6123;
                    $tds .= "<tr><td>{$nic}</td><td>{$fname}</td><td>{$district}</td>
                    <td><center><a class = 'addorapprove' href = /projects/Election/member/{$mid}>Action</a></center></td></tr>";
                }
                echo $tds;
            }
            else{
                echo "<tr><td colspan = '4'><center><h2>No Voters Found</h2></center></td></tr>";
            }
        ?>
    </table>
	
</section>

<!-- Pickup section ends -->
<br><br>
<!-- custom js file link  -->
<script src="script.js"></script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>