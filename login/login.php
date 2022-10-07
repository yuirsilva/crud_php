<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/db.php");
    include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/session.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="../style/fonts.css">
    <link rel="stylesheet" href="../style/reset.css">
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/fscreenmenu.css">
    <link rel="stylesheet" href="./login.css">

    <!-- Icons -->
    <?php include($_SERVER['DOCUMENT_ROOT']."/fand/included/icon.php"); ?>
    <title>Login | fand.</title>
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>
    <script async src="https://unpkg.com/es-module-shims@1.6.0/dist/es-module-shims.js"></script>
    <script type="importmap">
    {
        "imports": {
        "three": "https://unpkg.com/three@0.145.0/build/three.module.js"
        }
    }
    </script>
    <div class="cursor"></div>
    <main>
        <section class="main">
            <?php include($_SERVER['DOCUMENT_ROOT']."/fand/included/included.php"); ?>
            <div class="content">
                <div class="form">
                    <div class="welcome">
                        <h1>Login</h1>
                        <p>Bem-vindo de volta.</p>
                    </div>
                    <form action="login_process.php" method="post">
                        <label>
                            <span>Email</span>
                            <div class="input">
                                <input type="email" name="email" id="email" placeholder="Digite seu email">
                            </div>
                        </label>
                        <label>
                            <span>Password</span>
                            <div class="input">
                                <input type="password" name="pass" id="pass" placeholder="Digite sua senha">
                            </div>
                        </label>
                        <input type="submit" value="Entrar">
                        <div class="no-account">
                            <a href="./register/register.php">Não tem uma conta? <strong>Crie uma.</strong></a>
                        </div>
                    </form>
                </div>
                <div id="container"></div>
            </div>
        </section>
    </main>
    <script src="../scripts/cursor.js"></script>
    <script src="../scripts/menu.js"></script>
    <script type="module" src="./login.js"></script>
</body>
</html>