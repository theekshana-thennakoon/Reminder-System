<?php
session_start();
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
    <link rel="stylesheet" href="wrapstyle.css">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    
    <style>
    .header-1 img{width:30%;}
    .inputBox select , .inputBox input{
	  padding:1rem;font-size: 1.7rem;background:#f7f7f7;text-transform: none;
	  margin:1rem 0;border:.1rem solid rgba(0,0,0,.3);width: 49%;
    }
    .copyright{position:fixed;bottom:20px;right:10px;border:1px solid #ccc;padding:0.5%;z-index: 2;}
	
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
        <img src = 'logo1.png'></a></center>

    </div>

    

</header>
<!-- Pickup section starts  -->

<section class="contact">
	<form action='processing' method = 'post'>

        <div class='inputBox'>
            <input type = 'text' name = 'title' placeholder='Enter Title' maxlength="50" required>
            <select name = 'type' required>
                <option value="#">Select Category</option>
                <option value=""></option>
                <option value=""></option>
            </select>
        </div>
		
		<div class='inputBox'>
            <textarea name = 'discription' placeholder='Enter Description' required></textarea>
        </div>

        <div class='inputBox'>
            <input type = 'text' name = 'sdate' placeholder='Start Date' onfocus = "(this.type='date')" required>
            <input type = 'text' name = 'edate' placeholder='End Date' onfocus = "(this.type='date')" required>
        </div>
            <input type='submit' name = 'addrem' value='Set Remind' class='btn' style = 'background:#fe2121;'>
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
<script src="script.js"></script>
<?php

if(isset($_SESSION['sussessReg'])){
    $txt = 'Successfully Submited the Remind.';
    echo "<script>
        swal({
        title: 'Successfully',
            text: '$txt',
            icon: 'success',
        });
    </script>";
    unset($_SESSION['sussessReg']);
}

?>
<script src="scripts.js"></script>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</body>
</html>