<?php
session_start();
?>
<?php
include('database.php');
?>
<script src="sweetalert.min.js"></script>
<?php

if(isset($_POST['loginAdmin'])){
    $username = $_POST['usernameAdmin'];
    $pwd = $_POST['pwd'];
    $sql = "SELECT * FROM adminlogin where email = '{$username}'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $pasword = $row['pwd'];
            $id = $row['id'];
        }
        $verifypwd = password_verify($pwd, $pasword);
		if($verifypwd){
            $_SESSION['remlogin'] = $id;
            header("Location:main");
        }
        else{
            $_SESSION['wrongpwd'] = 100;
			echo "<script>window.history.back()</script>";
        }
    }
    else{
        $_SESSION['wrongemail'] = 100;
		echo "<script>window.history.back()</script>";
    }
    
}

if(isset($_POST['createAccount'])){
    $username = $_POST['usernameAdmin'];
    $sql = "SELECT * FROM adminlogin where email = '{$username}' and pwd = ''";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $id = $row['id'];
        }
        $password = $_POST['pwd'];
        $repassword = $_POST['repwd'];
        if($password ==  $repassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sqli = "UPDATE adminlogin set pwd = '{$hash}' where id = {$id}";
            if($conn->query($sqli) === TRUE){
                $_SESSION['remlogin'] = $id;
                header("Location:main");
            }
        }
        else{
            $_SESSION['wrongpwd'] = 100;
			echo "<script>window.history.back()</script>";
        }
    }
    else{
        $_SESSION['wrongemail'] = 100;
		echo "<script>window.history.back()</script>";
    }
    
}

if(isset($_POST['addrem'])){
	$title = $_POST['title'];
    //$type = $_POST['type'];
    $discription = $_POST['discription'];
    $uid = $_SESSION['remlogin'];
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
	$sqli = "INSERT INTO `register`(userid, title, description, sdate, edate) VALUES ($uid,'$title','$discription','$sdate','$edate')";
	if($conn->query($sqli) === TRUE){
		$_SESSION['sussessReg'] = 0;
		echo "<script>window.history.back()</script>";
	}
}

if(isset($_GET['correctionId'])){
	
    $correctionId = $_GET['correctionId'];
	$sqli = "UPDATE register set status = 'Corrected' where id = {$correctionId}";
	if($conn->query($sqli) === TRUE){
		echo "<script>window.history.back()</script>";
	}
}

if(isset($_GET['recorrectionId'])){
	
    $correctionId = $_GET['recorrectionId'];
	$sqli = "UPDATE register set status = null where id = {$correctionId}";
	if($conn->query($sqli) === TRUE){
		echo "<script>window.history.back()</script>";
	}
}
if(isset($_GET['logoutId'])){
    session_destroy();
	echo "<script>window.history.back()</script>";
}

if(isset($_GET['delId'])){
	
    $delId = $_GET['delId'];
	$sqli = "DELETE from register where id = {$delId}";
	if($conn->query($sqli) === TRUE){
		echo "<script>window.history.back()</script>";
	}
}

?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>