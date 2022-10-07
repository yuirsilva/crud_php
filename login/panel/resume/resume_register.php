<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/session.php");
    include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/db.php");

    if($_SESSION['loggedIn'] !== true){ exit(header('Location: ../logout.php')); }

    $sql = "SELECT * FROM curriculum WHERE id_user = :id_user";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id_user', $_SESSION['id']);
    $result = $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $heading = $submit_text = $disabled = null;

    if(!empty($rows)):
        $heading = 'Atualize seu currículo';
        $submit_text = 'Atualizar currículo';
        $disabled = '';
    else:
        $heading = 'Cadastre seu currículo';
        $submit_text = 'Cadastrar currículo';
        $disabled = 'disabled';
    endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="../../../style/fonts.css">
    <link rel="stylesheet" href="../../../style/reset.css">
    <link rel="stylesheet" href="../../../style/global.css">
    <link rel="stylesheet" href="../panel.css">
    <link rel="stylesheet" href="./resume_register.css">

    <!-- Flags -->
    <link rel="stylesheet" href="../tel-input/intlTelInput.css">

    <!-- Icons -->
    <?php include_once($_SERVER['DOCUMENT_ROOT']."/fand/included/icon.php"); ?>
    <title>Cadastro | fand.</title>
</head>
<body>
    <div class="cursor"></div>
    <main>
        <section class="main">
            <?php include_once('../menu.php'); ?>
            <div class="content-register">
                <div class="panel-mobile-menu">
                    <span>MENU</span>
                    <span>FECHAR</span>
                </div>
                <div class="form">
                    <h1><?= $heading ?></h1>
                    <form action="./resume_process.php" method="POST" name="resume">
                        <label>
                            <span>Nome completo</span>
                            <div class="input">
                                <input type="text" name="name" id="name" value="<?= $_SESSION['name'] ?>" placeholder="Digite seu nome completo" required <?= $disabled ?>>
                            </div>
                        </label>
                        <label>
                            <span>Email</span>
                            <div class="input">
                                <input type="email" name="email" id="email" value="<?= $_SESSION['email'] ?>" placeholder="Digite seu email" required <?= $disabled ?>>
                            </div>
                        </label>
                        <label>
                            <span>Telefone</span>
                            <div class="input">
                                <input type="tel" name="phone" id="phone" pattern="\d*" title="Digite um número de telefone válido" required>
                                <span id="error-msg" class="error-msg iti-hide">Número de telefone inválido!</span>
                            </div>
                        </label>
                        <label>
                            <span>Curso</span>
                            <div class="input">
                                <select name="course" id="course" required>
                                    <option value="" selected disabled>Por favor, selecione uma opção</option>
                                    <option value="Informática">Informática para Internet</option>
                                    <option value="Administração">Administração</option>
                                    <option value="Recursos Humanos">Recursos Humanos</option>
                                    <option value="Química">Química</option>
                                </select>
                            </div>
                        </label>
                        <input type="submit" value="<?= $submit_text ?>">
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script src="../tel-input/intlTelInput.min.js"></script>
    <script src="./resume_register.js"></script>
    <script src="../../../scripts/cursor.js"></script>
    <script src="../panel.js"></script>
</body>
</html>