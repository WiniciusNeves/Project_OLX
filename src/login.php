<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./public/css/login.css">
</head>
<body>
    <form action="index.php" method="post">
        <div class="container-login">
            <h1>Login</h1>
            <p>Please fill in this form to login</p>
            <label for="Email"> Email:</label>
            <input type="text" id="Email" name="Email" placeholder="example@example" required>
            <br><br>
            <label for="Password">Password:</label>
            <input type="password" id="Password" name="Password" placeholder="********" required>
            <br><br>
            <a href="javascript:alert('This page is under maintenance, please wait.');">Forgot Password?</a>
            <br><br>
            <button type="submit" id="submit" name="submit">Login</button><br>
            <a href="register.php">Don't have an account?</a>
        </div>
    </form>


    <?php
    include('config.php');

    if (isset($_POST['submit'])) {
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $sql = "SELECT * FROM users WHERE Email = '$email' AND Password = '$password'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        if ($row['Email'] == $email && $row['Password'] == $password) {
            header("Location: index.php");  
        } else {
            echo "Invalid username or password";
        }
    }
    ?>
    
</body>
</html>