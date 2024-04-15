<?php
include './views/config.php';
$modalScript = '';
if (isset($_GET['anunciar'])) {
    $modalScript = '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("meuModal");
            var span = document.getElementsByClassName("fechar")[0];

            modal.style.display = "block";

            span.onclick = function() {
                modal.style.display = "none";
                window.location.href = "index.php";
            };

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };
        });
    </script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLX</title>
    <link rel="stylesheet" href="./public/css/style.css">
</head>

<style>
    body {
        overflow: hidden;
    }
</style>

<body>
    <header>
        <div class="container-header" style="border-bottom:1px solid black; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius : 0px 0px 10px 10px; height: 80px;">
            <img src="./public/images/logo.jpeg" alt="" width="50" height="50" style="margin: 10px 50px 0px 50px;">

            <?php
            $password = (@$_GET['password']);
            $sql = "SELECT * FROM users WHERE `password` = ?";

            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['name'] = $row['name'];
                echo '<h2 style="margin: 10px 50px 0px 50px; font-size: 20px; color: rebeccapurple; position: absolute;top: 1rem; right: 15rem; text-align: center ; font-weight: bold">Bem vindo(a), em nosso site ' . htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8') . '!</h1>';
            } else {
                echo '<a href="./views/login.php"><input type="button" value="Login"></a>';
            }
            ?>
        </div>
    </header>
    <aside>
        <div class="container-aside">
            <div class="categories">
                <div class="box" id="box1">
                    <a href="#"><img src="./public/images/1.png" width="50" height="50" alt="" style="margin-left: 8px;"></a>
                    <ul style="list-style-type: none; padding: 0; margin: 0">
                        <li>tecnologia</li>
                    </ul>
                </div>
                <div class="box" id="box2">
                    <a href="#"><img src="./public/images/2.png" width="50" height="50" alt="" style="margin-left: 10px;"></a>
                    <ul style="list-style-type: none; padding: 0; margin: 0">
                        <li>decoração</li>
                    </ul>
                </div>
                <div class="box" id="box3">
                    <a href="#"><img src="./public/images/3.png" width="50" height="50" alt=""></a>
                    <ul style="list-style-type: none; padding: 0; margin: 0">
                        <li>Veiculos</li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <main>
        <div class="container-main">

            <span style="font-size: 20px; font-weight: bold; color: rebeccapurple; text-decoration: none; position: relative; top: 100px; left: 80px">
                <?php

                if (isset($_SESSION['name'])) {
                    echo '<a href="?anunciar"><input type="button" value="Adicionar anuncio"></a>';
                }elseif (!isset($_SESSION['name']) && !isset($_GET['anunciar'])) {
                    echo '<h2 style="margin: 10px 50px 0px 50px; font-size: 20px; color: rebeccapurple; position: absolute;top: 1rem; right: 15rem; text-align: center ; font-weight: bold">Aqui está faltando anúncio, venha e faça o seu!</h2>';
                }

                ?>
                <hr style="position: fixed; left: 70px; border: 1px solid rebeccapurple; width: 25vw;" />
            </span>
        </div>
        <div class="container-posts">
            <?php

            $sql = "SELECT * FROM posts ORDER BY id DESC";
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
                            <p style="margin: 0 20px 0 10px; font-size: 20px;">' . $row['description'] . '<p>
                        </div>
                       
                </div>';
                }
            }


            ?>
        </div>

        <div id="meuModal" class="container-modal" style="display: none; width: 100%; height: 100%; background-color: rgba(128, 128, 128, 0.5); position: fixed; top: 0; z-index: 1">
            <div class="modal-conteudo" style="position: relative; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 30rem; padding: 40px ; box-sizing: border-box; border-radius: 5px; box-shadow: 0 15px 25px rgba(0, 0, 0, 0.6); background-color: white; color: rebeccapurple;">
                <span class="fechar" style="position: absolute; top: 10px; right: 10px; font-size: 25px; cursor: pointer">&times;</span>
                <h1 style="text-align: center;">Anúncio</h1>
                <form action="#" method="post" enctype="multipart/form-data">
                    <label for="title">Título:</label><br>
                    <input type="text" id="title" name="title" required><br><br>
                    <label for="price">Preço:</label><br>
                    <input type="text" id="price" name="price" required><br><br>
                    <label for="description">Descrição:</label><br>
                    <textarea id="description" name="description" cols="40" rows="10" required style="resize: none; margin-top: 10px ; width: 25rem; height: 5rem"></textarea><br><br>
                    <label for="image">Foto:</label><br>
                    <input type="file" id="image" name="image[]" accept="image/*" multiple required><br><br>

                    <label for="category">Categoria:</label>
                    <select name="category" id="category" style="width: 15rem; height: 2rem; margin-top: 10px; border-radius: 5px; border: 1px solid #ccc;" required>
                        <option value="">Selecione aqui</option>
                        <option value="Decoração">decoration</option>
                        <option value="Tecnologia">Technology</option>
                        <option value="Carros">Cars</option>
                    </select><br><br>

                    <input type="submit" name="submit" value="Enviar">
                </form>
            </div>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $image = $_FILES['image']['tmp_name'];
            $imageData = file_get_contents($image[0]);
            $sql = "INSERT INTO posts (`title`, `price`, `description`, `category`, `image`) VALUES (?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sssss", $title, $price, $description, $category, $imageData);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo "Anúncio adicionado com sucesso!";
            } else {
                echo "Erro ao adicionar anúncio.";
            }
        }
        ?>



        </div>
        </div>
        <footer style="position: fixed; bottom: 0; width: 100vw; height: 30px; background-color: black; color: white; font-size: 8px; text-align: center; border-radius: 0px 0px 10px 10px">
            <h1>Direitos Reservados - 2024 por || Winicius Neves || João Brasil || Vinicius Anacleto || Matheus Ziem ||</h1>
        </footer>

        <?php echo $modalScript; ?>
    </main>

</body>

</html>