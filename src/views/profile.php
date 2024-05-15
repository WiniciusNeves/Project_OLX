<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta</title>
    <link rel="stylesheet" href="../public/css/profile.css">
    <link rel="shortcut icon" href="https://th.bing.com/th/id/OIP.rGPKSyDiXueEAV-7qQoPkwHaHa?rs=1&pid=ImgDetMain" type="image/x-icon">
</head>

<body>
    <div class="container-profile">

        <?php
        include('./config.php');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM users WHERE `id` = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $users_name = @$row['name'];
            $users_email = @$row['email'];
            $users_phone = @$row['phone'];
        }
        ?>

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
            <a href="../index.php?search"><input type="button" name="voltar" value="Voltar"></a>

        </form>
        <?php
        if (isset($_POST['alterar'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $confirmPassword = md5($_POST['confirmPassword']);
            $phone = $_POST['phone'];
            if ($password === $confirmPassword) {
                $sql = "UPDATE users SET name = ?, email = ?, password = ?, phone = ? WHERE id = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("ssssi", $name, $email, $password, $phone, $id);
                $stmt->execute();
                $stmt->close();
                header("Location: profile.php?id=" . $id);
            } else {
                echo '<script>alert("As senhas precisam ser iguais");</script>';
            }
        }

        ?>

    </div>
</body>

</html>