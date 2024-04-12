<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../public/css/login.css">
</head>

<body>
    <form action="index.php" method="post">
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
        if ($password == $confirmPassword) {
            $sql = "INSERT INTO users (Name, Email, Password, Phone, Role) VALUES ('$name', '$email', '$password', '$phone', 'regular')";
            $result = mysqli_query($con, $sql);
            if ($result) {
                header("Location: index.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        } else {
            echo "Password and Confirm Password are not the same";
        }
    }

    ?>

</body>

</html>