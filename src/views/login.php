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
            <h1>Login</h1>
            <p>Please fill in this form to log in</p>
            <label for="Email">Email:</label>
            <input type="text" id="Email" name="Email" placeholder="example@example" required>
            <br><br>
            <label for="Password">Password:</label>
            <input type="password" id="Password" name="Password" placeholder="********" required>
            <br><br>
            <a href="javascript:alert('This page is under maintenance, please wait.');">Forgot Password?</a>
            <br><br>
            <button type="submit" name="submit">Login</button><br>
            <a href="register.php">Don't have an account?</a>
        </div>
    </form>
    

    <?php
    include('config.php');
    if (isset($_POST['submit'])) {
        $Email = $_POST['Email'];
        $Password = md5($_POST['Password']);
        $sql = "SELECT * FROM users WHERE Email = '$Email' AND Password = '$Password'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['Email'] = $row['Email'];
            header('location: ../index.php?password=' . ($Password));
        }
        else {
            echo "Invalid Email or Password";
        }
    }
    ?>
</body>

</html>