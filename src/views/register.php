<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../public/css/login.css">
</head>

<body>
    <form action="#" method="post">
        <div class="container-login">
            <h1>Register</h1>
            <p>Please fill in this form to register</p>
            <label for="Name"> Name:</label>
            <input type="text" id="Name" name="Name" placeholder="example" required>
            <br><br>
            <label for="Email"> Email:</label>
            <input type="text" id="Email" name="Email" placeholder="example@example" required>
            <br><br>
            <label for="Password">Password:</label>
            <input type="password" id="Password" name="Password" placeholder="********" required>
            <br><br>
            <label for="ConfirmPassword">Confirm Password:</label>
            <input type="password" id="ConfirmPassword" name="ConfirmPassword" placeholder="********" required>
            <br><br>
            <label for="Phone">Phone:</label> 
            <input type="text" id="Phone" name="Phone" placeholder="(12)1234-5678" required>


            <a href="javascript:alert('This page is under maintenance, please wait.');">Forgot Password?</a>
            <br><br>
            <button type="submit" id="submit" name="submit">Register</button><br>
            <a href="login.php">Already have an account?</a>

        </div>
    </form>


    <?php
    include('config.php');
    if (isset($_POST['submit'])) {
        $name = $_POST['Name'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $confirmPassword = $_POST['ConfirmPassword'];
        $phone = $_POST['Phone'];
        if ($password === $confirmPassword) {
            $sql = "INSERT INTO users (`name`, `email`, `password`, `phone`, `role`) VALUES (?, ?, ?, ?, 'regular')";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $password, $phone);
            mysqli_stmt_execute($stmt);
            if (mysqli_stmt_affected_rows($stmt) == 1) {
                header("Location: login.php");
            } else {
                echo "Error: " . mysqli_error($con);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Password and Confirm Password are not the same";
        }
    }
    ?>

</body>

</html>