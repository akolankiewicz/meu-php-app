<?php
session_start();
! $_SESSION['auth'] && header('Location: login-screen.html');
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tela de Login</title>
    <link rel="icon" href="img/ascend_stats_circle_border.png" type="image/x-icon">
    <link rel="stylesheet" href="css/register-dark-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="dark-theme">
<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <div class="register-logo">
                <img src="img/ascend_stats_circle_border.png" alt="Ascend Stats Logo">
                <h1>Ascend Stats</h1>
            </div>
            <a href="collaborators.php" class="breadcrumb-link">
                <i class="bi bi-arrow-left"></i>
                Voltar aos Colaboradores
            </a>
        </div>

        <form action="actions/action_register.php" method="post" class="register-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="nome">
                        <i class="bi bi-person"></i>
                        <span>Nome Completo</span>
                    </label>
                    <input type="text" id="nome" name="nome" placeholder="Nome completo" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">
                        <i class="bi bi-envelope"></i>
                        <span>E-mail</span>
                    </label>
                    <input type="email" id="email" name="email" placeholder="E-mail" required>
                </div>
            </div>

            <div class="form-row two-columns">
                <div class="form-group">
                    <label for="cidade">
                        <i class="bi bi-lock"></i>
                        <span>Senha</span>
                    </label>
                    <input type="password" id="senha" name="senha" placeholder="Senha" required>
                </div>

                <div class="form-group">
                    <label for="nivel">
                        <i class="bi bi-person-gear"></i>
                        <span>Nível do usuário</span>
                    </label>
                    <select id="nivel" name="nivel" class="form-control" required>
                        <option value="" disabled selected>Selecione o nível</option>
                        <?php if ($_SESSION['type_user'] == 1) { ?>
                            <option value="1">Administrador</option>
                        <?php } ?>
                        <option value="2">Analista</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="telefone">
                        <i class="bi bi-telephone"></i>
                        <span>Telefone</span>
                    </label>
                    <input type="tel" id="telefone" name="telefone" placeholder="Telefone">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="data_nascimento">
                        <i class="bi bi-calendar"></i>
                        <span>Data de nascimento</span>
                    </label>
                    <input type="date" id="data_nascimento" name="data_nascimento" required>
                </div>
            </div>

            <div class="form-row two-columns">
                <div class="form-group">
                    <label for="cidade">
                        <i class="bi bi-building"></i>
                        <span>Cidade</span>
                    </label>
                    <input type="text" id="cidade" name="cidade" placeholder="Cidade">
                </div>

                <div class="form-group">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-control" id="estado" name="estado">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="endereco">
                        <i class="bi bi-house"></i>
                        <span>Endereço</span>
                    </label>
                    <input type="text" id="endereco" name="endereco" placeholder="Endereço completo">
                </div>
            </div>

            <button type="submit" class="register-button">
                <span>Cadastrar</span>
                <i class="bi bi-check-circle"></i>
            </button>
        </form>
    </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="js/error_authentication_messages.js"></script>
<script src="js/utils.js"></script>
</body>
</html>