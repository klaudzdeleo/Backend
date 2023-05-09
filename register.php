<?php require './config/config.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">


</head>

<body>

    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password = md5($password);
        $stmt = $conn->prepare("INSERT INTO `user_account` (`username`,`email`,`password`) VALUES (?,?,?)");
        $stmt->bind_param("sss", $username, $email, $password);
        $result = $stmt->execute();
        if ($result) {
            $_SESSION['uname'] = $username;
            header("location: page1.php");
        }
    }
    ?>
    <center> <img src="logo.png" width=300 height=100></center>
    <main>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="myDiv">
                <h1>Sign Up</h1>
                <br><br>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
                <br><br>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                <br><br>
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password" id="password" required>
                <br><br>
                <label for="password2">Password Again:</label>
                <input type="password" placeholder="Confirm Password" id="confirm_password" required>
                <br>

                <input type="submit" name="submit" value="SignUp">
                <footer>Already have an account ? <a href="login.php">Login here</a></footer>
        </form>
        </div>


    </main>

    <script>
        var password = document.getElementById("password"),
            confirm_password = document.getElementById("confirm_password");

        function validatePassword() {
            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
</body>

</html>