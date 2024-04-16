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
                window.location.href = "index.php?password=' . htmlspecialchars($_GET['password']) . '";
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
<?php
$configmodel = '';
if (isset($_GET['config'])) {
    $configmodel = '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var modal1 = document.getElementById("config-Modal");
            var span1 = document.getElementsByClassName("fechar2")[0];

            modal1.style.display = "flex";

            span1.onclick = function() {
                modal1.style.display = "none";
                window.location.href = "index.php?password=' . htmlspecialchars($_GET['password']) . '";
            };

            window.onclick = function(event) {
                if (event.target == modal1) {
                    modal1.style.display = "none";
                }
            };
        });
    </script>';
} elseif (empty($_GET['config'])) {
    $configmodel = '';
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


<body>
    <header>
        <div class="container-header">
            <a href="index.php"><img src="./public/images/logo.jpeg" alt="" width="50" height="50" style="margin: 10px 50px 0px 50px;"></a>

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
                echo '<h2 style="margin: 10px 50px 0px 50px; font-size: 20px; color: rebeccapurple; position: fixed;top: 1rem; right: 15rem; text-align: center ; font-weight: bold"><a href="?password=' . htmlspecialchars($_GET['password'], ENT_QUOTES, 'UTF-8'), '&config" ">Bem vindo(a), em nosso site ' . htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8') . '!</a></h2>';
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
                <a href="./filter/tec.php" style="text-decoration: none; "><img src="./public/images/1.png" width="50" height="50" alt="" style="margin-left: 8px;">
                    <ul style="list-style-type: none; padding: 0; margin: 0">
                        <li>tecnologia</li>
                    </ul>
                </a>
            </div>

            <div class="box" id="box2">
                <a href="./filter/dec.php" style="text-decoration: none; "><img src="./public/images/2.png" width="50" height="50" alt="" style="margin-left: 10px;">
                    <ul style="list-style-type: none; padding: 0; margin: 0">
                        <li>decoração</li>
                    </ul>
                </a>
            </div>
            <div class="box" id="box3">
                <a href="./filter/car.php" style="text-decoration: none;"><img src="./public/images/3.png" width="50" height="50" alt="">
                    <ul style="list-style-type: none; padding: 0; margin: 0">
                        <li>Veiculos</li>
                    </ul>
                </a>
            </div>
        </div>
    </aside>
    <main>
        <div class="container-main">

            <span style="font-size: 20px; font-weight: bold; color: rebeccapurple; text-decoration: none; position: relative; top: 100px; left: 80px">
                <?php
                if (isset($_SESSION['name'])) {
                    echo '<a href="?password=' . htmlspecialchars($_GET['password'], ENT_QUOTES, 'UTF-8') . '&anunciar"><input type="button" value="Adicionar anuncio"></a>';
                } elseif (!isset($_SESSION['name']) && !isset($_GET['anunciar'])) {
                    echo '<h2 style="margin: 10px 50px 0px 50px; font-size: 20px; color: rebeccapurple; position: absolute;top: 1rem; right: 15rem; text-align: center ; font-weight: bold">Aqui está faltando anúncio, venha e faça o seu!</h2>';
                }

                ?>
            </span>

        </div>
        <div class="container-posts " id="filtered">
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
                            <p style="margin: 0 20px 0 10px; font-size: 15px;">' . $row['description'] . '<p>
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
                <form action="" method="post" enctype="multipart/form-data">
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
                        <option value="Decoração">decoração</option>
                        <option value="Tecnologia">tecnologia</option>
                        <option value="Carros">Carros</option>
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
            $image = $_FILES['image'];

            $password = (@$_GET['password']);

            $sql = "SELECT * FROM users WHERE `password` = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $password);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $users_id = $row['id'];

            foreach ($image['tmp_name'] as $key => $value) {
                $imageData = file_get_contents($value);

                $sql = "INSERT INTO posts (`title`, `price`, `description`, `category`, `image`, `users_id`) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("ssssss", $title, $price, $description, $category, $imageData, $users_id);
                $stmt->execute();
            }

            if ($stmt->affected_rows > 0) {
                echo "Anúncio adicionado com sucesso!";
            } else {
                echo "Erro ao adicionar anúncio.";
            }
        }
        ?>

        </div>

        <?php
        if (isset($_GET['password'])) {
            $password = $_GET['password'];
            $sql = "SELECT * FROM users WHERE `password` = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $password);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $users_name = $row['name'];
            $users_email = $row['email'];
            $users_phone = $row['phone'];
        }

        if (isset($_POST['alterar'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = md5($_POST['password']);
            $confirmPassword = md5($_POST['confirmPassword']);
            if ($password === $confirmPassword) {
                $sql = "UPDATE users SET `name` = ?, `email` = ?, `phone` = ? WHERE `password` = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("ssss", $name, $email, $phone, $password);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    echo "<script>alert('Informações atualizadas com sucesso!')</script>";
                } else {
                    echo "Erro ao atualizar informações.";
                }
            } else {
                echo "Password and Confirm Password are not the same";
            }
        }

        if (isset($_GET['password'])) {
            $password = $_GET['password'];
            $sql = "SELECT * FROM users WHERE `password` = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $password);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if (isset($row['id'])) {
                $users_id = $row['id'];

                $sql = "SELECT * FROM posts WHERE `users_id` = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("s", $users_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $category = $row['category'];
            }
        }

        ?>

        <div id="config-Modal" class="container-modal" style="display: none; width: 100%; height: 100%; background-color: rgba(128, 128, 128, 0.5); position: fixed; top: 0;">
            <div class="modal-conteudo" style="flex: 1; padding: 40px; box-sizing: border-box; border-radius: 5px; background-color: white; color: rebeccapurple; width: 80rem; position: fixed; top: 100px; left: 50%; transform: translateX(-50%); ">
                <span class="fechar2" style="position: absolute; top: 10px; left: 20px; font-size: 25px; cursor: pointer">&times;</span>
                <h1 style="text-align: left;">Configuração de conta</h1>
                <form action="#" method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column ;width: 30rem ;margin-left:25px ">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" value="<?php echo $users_name ?>" required>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $users_email ?>" required>
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required>
                    <label for="confirmPassword">Confirmar senha:</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                    <label for="phone">Telefone:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo $users_phone ?>" required>
                    <input type="submit" name="alterar" value="Alterar dados">
                </form>
                <div style="border-left: 2px solid black; height: 100%; position: absolute; left: 50%; top: 0; transform: translateX(-50%)"></div>
                <div class="modal-anuncios" style="display: flex; flex-direction: column; width: 38rem; position: fixed; top: 0rem; right: 0rem; overflow: auto; max-height: 90%; padding: 40px; box-sizing: border-box; border-radius: 5px; background-color: white; color: rebeccapurple;">
                    <h1>Seus anúncios</h1>
                    <?php

                    if (isset($users_id)) {

                        $sql = "SELECT * FROM posts WHERE `users_id` = ?";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param("s", $users_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {

                            while ($row = $result->fetch_assoc()) {
                                echo '<form action="#" method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column ;width: 30rem ;margin-left:25px ">
                            <label for="title" style="margin-top: 15px;">Título:</label>
                            <input type="text" id="title" name="title" value="' . $row['title'] . '" required>
                            <label for="price">Preço:</label>
                            <input type="text" id="price" name="price" value="' . $row['price'] . '" required>
                            <label for="description">Descrição:</label>
                            <input type="text" id="description" name="description" value="' . $row['description'] . '">

                            <label for="category" style="margin-top: 15px;">Categoria:</label>
                            <select name="category" id="category" style="width: 15rem; height: 2rem; margin-top: 10px; border-radius: 5px; border: 1px solid #ccc;">
                                <option value="">Selecione aqui</option>
                                <option value="Decoração" ' . ($row['category'] === 'Decoração' ? 'selected' : '') . '>Decoração</option>
                                <option value="Tecnologia" ' . ($row['category'] === 'Tecnologia' ? 'selected' : '') . '>Tecnologia</option>
                                <option value="Carros" ' . ($row['category'] === 'Carros' ? 'selected' : '') . '>Carros</option>
                            </select>

                            <input type="hidden" name="id" value="' . $row['id'] . '">
                            <input type="submit" name="alterar-anuncio" value="Alterar dados" style="margin-top: 15px;"></input>
                        </form>
                            ';
                            }
                        } else {
                            echo "<p>Você ainda não tem anúncios.</p>";
                        }
                    }
                    if (isset($_POST['alterar-anuncio'])) {
                        $id = $_POST['id'];
                        $title = $_POST['title'];
                        $price = $_POST['price'];
                        $description = $_POST['description'];
                        $category = $_POST['category'];
                        $sql = "UPDATE posts SET `title` = ?, `price` = ?, `description` = ?, `category` = ? WHERE `id` = ?";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param("ssssi", $title, $price, $description, $category, $id);
                        $stmt->execute();
                        if ($stmt->affected_rows > 0) {
                            echo "<script>alert('Informações atualizadas com sucesso!')
                            window.location.href = 'index.php?password=" . $password . "';</script>";
                        } else {
                            echo "Erro ao atualizar informações.";
                        }
                    }
                    ?>
                </div>



            </div>
        </div>
    </main>
    <footer style="position: fixed; bottom: 0; width: 100vw; height: 30px; background-color: black; color: white; font-size: 8px; text-align: center; border-radius: 0px 0px 10px 10px">
        <h1>Direitos Reservados - 2024 por || Winicius Neves || João Brasil || Vinicius Anacleto || Matheus Ziem ||</h1>
    </footer>
    <?php echo $configmodel; ?>
    <?php echo $modalScript; ?>


</body>

</html>