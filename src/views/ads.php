<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seus anúncios</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/css/ads.css">
</head>

<body>
    <main>
        <div id="container-ads">
            <h1>Seus anúncios</h1>

            <?php
            include('config.php');

            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM posts WHERE `users_id` = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("s", $id);
                $stmt->execute();
                $result = $stmt->get_result();


                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<form action="#" method="post" enctype="multipart/form-data">
            <table>
            <tr>
                <th>Título: </th>
                <td><input type="text" name="title" value="' . $row['title'] . '" required></td>
            </tr>
            <tr>
                <th>Preço:</th>
                <td><input type="text" name="price" value="' . $row['price'] . '" required></td>
            </tr>
            <tr>
                <th>Descrição:</th>
                <td><input type="text" name="description" value="' . $row['description'] . '"></td>
            </tr>
            <tr>
                <th>Categoria:</th>
                <td>
                    <select name="category">
                        <option value="">Selecione aqui</option>
                        <option value="Decoração" ' . ($row['category'] === 'Decoração' ? ' selected' : '') . '>Decoração</option>
                        <option value="Tecnologia"' . ($row['category'] === 'Tecnologia' ? ' selected' : '') . '>Tecnologia</option>
                        <option value="Carros"' . ($row['category'] === 'Carros' ? ' selected' : '') . '>Carros</option>
                    </select>
                </td>
            </tr>';

                        // Verifica se o usuário é um administrador
                        $sql = "SELECT `role` FROM users WHERE id = ?";
                        $stmt = $con->prepare($sql);
                        $stmt->bind_param("s", $id);
                        $stmt->execute();
                        $result2 = $stmt->get_result();
                        $row3 = $result2->fetch_assoc();

                        if (is_array($row3) && $row3['role'] == 'admin') {
                            echo '<tr>
                <th>Situação:</th>
                <td>
                    <select name="situation">
                        <option value="">Selecione aqui</option>
                        <option value="Pendente" ' . ($row['situation'] === 'pending' ? 'selected' : '') . '>Pendente</option>
                        <option value="Aprovado" ' . ($row['situation'] === 'Aprovado' ? 'selected' : '') . '>Aprovado</option>
                        <option value="Reprovado" ' . ($row['situation'] === 'Reprovado' ? 'selected' : '') . '>Reprovado</option>
                    </select>
                </td>
                <td><button type="submit" name="aprovar-anuncio" value="Aprovar anúncio">Aprovar anúncio</button></td>
            </tr>';
                        } else {
                            echo '<tr>
                <th>Situação:</th>
                <td>' . (isset($row['situation']) ? $row['situation'] : '') . '</td>
            </tr>';
                        }

                        echo '<tr>
                <td colspan="2" style="text-align: right;">
                    <input type="hidden" name="id" value="' . (isset($row['id']) ? $row['id'] : '') . '">
                    <input type="submit" name="alterar-anuncio" value="Alterar dados">
                    <input type="submit" name="deletar-anuncio" value="Deletar anúncio">
                </td>
            </tr>
           
        </table>
        </form>';
                    }
                } else {
                    echo "Nenhum anúncio encontrado.";
                }
            }
            if (isset($_POST['aprovar-anuncio'])) {
                $id = $_POST['id'];
                $situation = $_POST['situation'];
                $sql = "UPDATE posts SET situation = ? WHERE id = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("ss", $situation, $id);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    echo '<script>alert("Anúncio aprovado com sucesso!"); window.location.href="ads.php?id=' . $_GET['id'] . '"</script>';
                } else {
                    echo "<script>alert('Erro ao aprovar anúncio.'); window.location.href='ads.php'</script>";
                }
            }
            if (isset($_POST['alterar-anuncio'])) {
                $id = $_POST['id'];
                $title = $_POST['title'];
                $price = $_POST['price'];
                $description = $_POST['description'];
                $category = $_POST['category'];
                $sql = "UPDATE `posts` SET `title` = ?, `price` = ?, `description` = ?, `category` = ? WHERE `id` = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("ssssi", $title, $price, $description, $category, $id);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    echo '<script>alert("Anúncio alterado com sucesso"); window.location.href="ads.php?id=' . $_GET['id'] . '"</script>';
                } else {
                    echo "<script>alert('Erro ao alterar anúncio.');'</script>";
                }
            }
            if (isset($_POST['deletar-anuncio'])) {
                $id = $_POST['id'];
                $sql = "DELETE FROM `posts` WHERE `id` = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    echo '<script>alert("Anúncio deletado com sucesso"); window.location.href="ads.php?id=' . $_GET['id'] . '"</script>';
                } else {
                    echo "<script>alert('Erro ao deletar anúncio.');'</script>";
                }
            }

            ?>
            <a href="../index.php?id=<?php echo $id ?>"><input type="button" value="Voltar"></a>
        </div>

    </main>


</body>

</html>