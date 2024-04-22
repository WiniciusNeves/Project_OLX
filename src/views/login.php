<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../public/css/login.css">
    <link rel="shortcut icon" href="https://th.bing.com/th/id/OIP.rGPKSyDiXueEAV-7qQoPkwHaHa?rs=1&pid=ImgDetMain" type="image/x-icon">
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
   session_start();
   
   if (isset($_POST['submit'])) {
    $Email = $_POST['Email'];
    $Password = md5($_POST['Password']);
    
    $sql = "SELECT id FROM users WHERE Email = ? AND Password = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $Email, $Password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
      
        $row = $result->fetch_assoc();
        $id = $row['id'];

        $_SESSION['Email'] = $Email;
        $_SESSION['id'] = $id;

        header('location: ../index.php?id=' . $id);
        exit();
    } else {
 
        echo "Invalid Email or Password";
    }
}
?>
   
</body>

</html>