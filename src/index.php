<?php
$modalScript = '';
if (isset($_GET['anunciar'])) {
    $modalScript = '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var modal = document.getElementById("meuModal");
                var span = document.getElementsByClassName("fechar")[0];

                modal.style.display = "block";

                span.onclick = function() {
                    modal.style.display = "none";
                }

                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }
            });
        </script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OLX Copy</title>
    <link rel="stylesheet" href="./public/css/style.css">
</head>

<body>
    <header>
        <div class="container-header" style="border-bottom:1px solid black; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border-radius : 0px 0px 10px 10px; height: 80px;">
            <img src="./public/images/OLX-logo-big.png" alt="" width="50" height="50" style="margin: 10px 50px 0px 50px;">
            <a href="?anunciar=1"><input type="button" value="Anunciar"></a>
            <a href="./views/login.php"><input type="button" value="Login" style="background-color: white; color: black"></a>
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
            <span style="font-size: 20px ; font-weight: bold ; color: rebeccapurple; text-decoration: underline ; position: relative; top: 100px ; left: 80px">
                Mais recentes
                <hr style="position: fixed; left: 70px; border: 1px solid rebeccapurple; width: 25vw;" />
            </span>
        </div>
        <div id="meuModal" class="modal" style="display: none; width: 100%; height: 100%; background-color: rgba(128, 128, 128, 0.5); position: fixed; top: 0; z-index: 1">
            <div class="modal-conteudo" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 25rem; padding: 40px ; box-sizing: border-box; border-radius: 5px; box-shadow: 0 15px 25px rgba(0, 0, 0, 0.6); background-color: white; color: rebeccapurple;">
                <span class="fechar" style="position: absolute; top: 10px; right: 10px; font-size: 25px; cursor: pointer" >&times;</span>
                <h1 style="text-align: center;">Anuncio</h1>
                <form action="Anunciar.php" method="post" enctype="multipart/form-data">
                    <label for="title">Título:</label><br>
                    <input type="text" id="title" name="title" required><br><br>
                    <label for="price">Preço:</label><br>
                    <input type="text" id="price" name="price" required><br><br>
                    <label for="description">Descrição:</label><br>
                    <textarea id="description" name="description" cols="40" rows="10" required style="resize: none; margin-top: 10px"></textarea><br><br>
                    <label for="image">Foto:</label><br>
                    <input type="file" id="image" name="image[]" accept="image/*" multiple required><br><br>
                    <input type="submit" value="Enviar">
                </form>
                
            </div>
        </div>
        <footer style="position: fixed; bottom: 0; width: 100vw; height: 30px; background-color: black; color: white; font-size: 8px; text-align: center; border-radius: 0px 0px 10px 10px">
            <h1>Direitos Reservados - 2024 por ||Winicius Neves || João Brasil || Vinicius Anacleto || Matheus Ziem ||</h1>
        </footer>

        <?php echo $modalScript; ?>
    </main>

</body>

</html>