<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="style.css">


</head>

<body>
    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST["uname"];
        $password = md5($_POST['upass']);
        
        $stmt = $conn->prepare("SELECT * FROM `user_account` WHERE `username`=? AND `password`=?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result)==1) {
            $_SESSION['uname'] = $username;
            header("location: page1.php");
        } else {
            header("location: login.php");
        }
    }
    ?>


    <center> <img src="logo.png" width=300 height=100></center>
    <div class="myDiv">
        <h2>Login</h2>
        <p>Please fill in your credentials to login</p>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            Username<br>
            <input type="text" name="uname" id="uname"><br>
            Password<br>
            <input type="password" name="upass" id="upass"><br>
            <input type="submit" name="submit" value="Login" >
            <p>Don't have an account ? <a href="register.php">Sign up now.</a></p>
        </form>
    </div>