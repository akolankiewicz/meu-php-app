<?php
session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Players | Ascend Stats</title>
    <link rel="icon" href="img/ascend_stats_circle_border.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header id="navbar-header"></header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <section class="login-intro">
                    <h1 class="principal-title">Aba Jogadores - Aqui poderá encontrar e cadastrar seus jogadores</h1>
                        <button class="btn btn-success">Filtrar</button>
                </section>
            </div>
            <div class="col-md-2">
                <img src="img/ascend_stats_shirt.png" alt="erro" width="300">
            </div>
        </div>
    </div>

    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Posição</th>
                <th scope="col">Peso</th>
                <th scope="col">Altura</th>
                <th scope="col">Idade</th>
                <th scope="col">Data de nascimento</th>
                <th scope="col">Clube Atual</th>
                <th scope="col">Jogos</th>
                <th scope="col">Gols</th>
                <th scope="col">Ver Mais</th>
            </tr>
            </thead>
            <tbody>
            <?php

//            while($user_data = mysqli_fetch_assoc($result))
//            {
//                echo "<tr>";
//                echo "<td>".$user_data['id']."</td>";
//                echo "<td>".$user_data['nome']."</td>";
//                echo "<td>".$user_data['senha']."</td>";
//                echo "<td>".$user_data['email']."</td>";
//                echo "<td>".$user_data['telefone']."</td>";
//                echo "<td>".$user_data['sexo']."</td>";
//                echo "<td>".$user_data['data_nasc']."</td>";
//                echo "<td>".$user_data['cidade']."</td>";
//                echo "<td>".$user_data['estado']."</td>";
//                echo "<td>".$user_data['endereco']."</td>";
//                echo "<td>
//        <a class='btn btn-sm btn-primary' href='edit.php?id=$user_data[id]'>
//        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
//        <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325'/>
//        </svg>
//        </a>
//        <a class='btn btn-sm btn-danger' href='delete.php?id=$user_data[id]'>
//        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
//        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
//      </svg>
//        </a>
//        </td>";
//                echo "</tr>";
//            }
            ?>
            </tbody>
        </table>
    </div>



    <footer id="footer-footer" class="bg-dark text-white py-4 mt-7"></footer>

    <script src=""></script>
    <script src="js/on_open.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tYhFbargfWtaeZUBDzF4A1jzE+4jBGTFe1m5b0jaQmAzm0fj1Qp6F8Q+" crossorigin="anonymous"></script>
    <script src="js/navbar.js"></script>
    <script src="js/footer.js"></script>
    <script src="js/search_player.js"></script>
</body>
</html>

