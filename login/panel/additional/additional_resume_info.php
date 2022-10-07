<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/session.php");
    include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/db.php");

    if($_SESSION['loggedIn'] !== true){ exit(header('Location: ../logout.php')); }

    $typeRegister = $_GET['typeRegister'];
    $lTypeRegister = strtolower($typeRegister);

    switch ($typeRegister)
    {
        case 'Educação':
            $typeRegister = 'Instituição';
            break;
        case 'Experiência profissional':
            $typeRegister = 'Ocupação';
            break;
    }
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
    <link rel="stylesheet" href="../resume/resume_register.css">
    <link rel="stylesheet" href="./additional_resume_info.css">

    <!-- Icons -->
    <?php include_once($_SERVER['DOCUMENT_ROOT']."/fand/included/icon.php"); ?>
    <title>Informações | fand.</title>
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
                    <h1>Cadastrar <?= $lTypeRegister ?></h1>
                    <form action="./additional_process.php" method="POST">
                        <label>
                            <span><?= $typeRegister ?></span>
                            <div class="input">
                                <input type="text" name="first-field" id="first-field" placeholder="Digite sua <?= strtolower($typeRegister) ?>" oninvalid="this.setCustomValidity('Digite uma <?= strtolower($typeRegister) ?> válida')" oninput="setCustomValidity('')" required>
                            </div>
                        </label>
                        <?php
                            switch ($lTypeRegister)
                            {
                                default: // do nothing;
                                break;
                                case 'educação':
                        ?>
                        <label>
                            <span>Curso</span>
                            <div class="input">
                                <input type="text" name="course" id="course" placeholder="Digite o curso" oninvalid="this.setCustomValidity('Digite um curso válido')" oninput="setCustomValidity('')" required>
                            </div>
                        </label>
                        <?php
                                break;
                                case 'experiência profissional':
                        ?>
                        <label>
                            <span>Empresa</span>
                            <div class="input">
                                <input type="text" name="company" id="company" placeholder="Digite a empresa" oninvalid="this.setCustomValidity('Digite uma empresa válida')" oninput="setCustomValidity('')" required>
                            </div>
                        </label>
                        <?php
                                break;
                            }
                        ?>
                        <?php if ($lTypeRegister == 'educação' || $lTypeRegister == 'experiência profissional'): ?>
                        <label>
                            <span>Início</span>
                            <div class="input">
                                <input type="date" name="start-course-date" id="start-course-date" min="1950-01-01" max="2022-12-31" oninvalid="this.setCustomValidity('Digite uma data de início válida')" oninput="setCustomValidity('')" required>
                            </div>
                        </label>
                        <label>
                            <span>Término</span>
                            <div class="input">
                                <input type="date" name="end-course-date" id="end-course-date" min="1950-01-01" max="2099-12-31" oninvalid="this.setCustomValidity('Digite uma data de término válida')" oninput="setCustomValidity('')" required>
                            </div>
                        </label>
                        <?php
                            endif;
                        ?>
                        <input type="hidden" name="register-type" value="<?= $lTypeRegister ?>">

                        <div>
                            <a href="../panel.php">Cancelar</a>
                            <input type="submit" value="Cadastrar">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script src="../../../scripts/cursor.js"></script>
    <script src="../panel.js"></script>
</body>
</html>