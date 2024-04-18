<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLX</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<style>
    body {
    }
</style>


<body>
    <header>
        <div class="container-header">
            <a href="../index.php"><img src="../public/images/logo.jpeg" alt="" width="50" height="50" style="margin: 10px 50px 0px 50px;"></a>

            <?php
            include('../views/config.php');
            $id = (@$_GET['id']);
            $sql = "SELECT * FROM users WHERE `id` = ?";

            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['name'] = $row['name'];
                echo '<h2 style="margin: 10px 50px 0px 50px; font-size: 20px; color: rebeccapurple; position: fixed;top: 1rem; right: 15rem; text-align: center ; font-weight: bold"><a href="?id=' . htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8') . '&config" ">Bem vindo(a), em nosso site ' . htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8') . '!</a></h2>';
            } else {
                echo '<a href="./views/login.php"><input type="button" value="Login"></a>';
            }
            ?>
        </div>
    </header>
    <aside>
        <div class="container-aside">
            <div class="categories"">
                <div class=" box" id="box1">
                <a href="#" style="text-decoration: none; "><img src="../public/images/1.png" width="50" height="50" alt="" style="margin-left: 8px;">
                    <ul style="list-style-type: none; padding: 0; margin: 0">
                        <li>tecnologia</li>
                    </ul>
                </a>
            </div>

            <div class="box" id="box2">
                <a href="dec.php?id=<?php echo $id?>" style="text-decoration: none; "><img src="../public/images/2.png" width="50" height="50" alt="" style="margin-left: 10px;">
                    <ul style="list-style-type: none; padding: 0; margin: 0">
                        <li>decoração</li>
                    </ul>
                </a>
            </div>
            <div class="box" id="box3">
                <a href="car.php?id=<?php echo $id ?>" style="text-decoration: none;"><img src="../public/images/3.png" width="50" height="50" alt="">
                    <ul style="list-style-type: none; padding: 0; margin: 0">
                        <li>Veiculos</li>
                    </ul>
                </a>
            </div>
        </div>
    </aside>
    <main>
       
        <div class="container-main">
            <?php

            $sql = "SELECT * FROM posts WHERE category = 'tecnologia' ORDER BY id DESC";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="post" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); width: 300px; height: 500px; margin: 20px; float: left; border-radius: 10px; position: relative; top: 100px; left: 40px ; background-color: white ">
            <div class="image" style="border-top-left-radius: 10px; border-top-right-radius: 10px">
                <img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="" width="100%" height="250px">
            </div>
            <div class="price" style="color: rebeccapurple; font-size: 20px; font-weight: bold; text-align: right; position: relative; top: -20px; border-top-left-radius: 10px; border-top-right-radius: 10px; background-color: white; border-top:3px solid #90ee90">
              <h2 style="margin: 0 20px 0 10px" font-size: 25px> R$ ' . $row['price'] . '<h2>
            </div>
            <div class="title" style="text-align: left; position: relative; top: -45px; background-color: white; font-size: 20px; font-weight: bold; color: rebeccapurple">
                <h1 style="margin: 0 20px 0 10px; font-size: 20px;">' . $row['title'] . '<h1>
            </div>
            <div class="category" style="text-align: right; position: relative; top: -73px; background-color: white; font-size: 20px; font-weight: bold;color: rebeccapurple">
                <p style="margin: 0 20px 0 10px; font-size: 20px;"> Categoria: ' . $row['category'] . '<p>
            </div>
            <div class="description" style="text-align: left; position: relative; top: -80px; background-color: white; font-size: 20px; font-weight: bold; width: auto height: auto; color: rebeccapurple ;front-family: sans-serif  ">
                <p style="margin: 0 20px 0 10px; font-size: 15px;">' . $row['description'] . '<p>
            </div>
           
    </div>';
                }
            }


            ?>
    </main>
</body>

</html>