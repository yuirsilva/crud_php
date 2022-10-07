<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="./style/fonts.css">
    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/global.css">
    <link rel="stylesheet" href="./style/fscreenmenu.css">
    <link rel="stylesheet" href="./style/style.css">

    <!-- Icons -->
    <?php include($_SERVER['DOCUMENT_ROOT']."/fand/included/icon.php"); ?>
    <title>fand. | ETEC MCM</title>
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
    <div class="intro-wrapper">
        <div class="intro-wrapper-logo">
            <h1>fand.</h1>
        </div>
        <div>
            <h1>conectando</h1>
        </div>
        <div>
            <h1>pessoas</h1>
        </div>
        <img src="./style/imgs/loadingBackground.svg" alt="Loading Background">
    </div>
    <div class="cursor"></div>
    <main>
        <section class="main">
            <?php include($_SERVER['DOCUMENT_ROOT']."/fand/included/included.php"); ?>
            <div id="container"></div>
            <div class="content">
                <h1><span>CONECTANDO</span> pessoas.</h1>
                <p>Banco de currículos da ETEC MCM.</p>
                <div class="main-buttons">
                    <?php require_once('./included/included.php'); ?>
                    <a class="cta-button" href="<?= $path ?>fand/login/login.php">
                        <div>
                            <span>Começar agora</span>
                        </div>
                    </a>
                    <a href="#faq">
                        <svg width="21" height="12" viewBox="0 0 21 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 1.625L10.5 11L1 1.625" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
        <section class="faq" id="faq">
            <h1>FAQ</h1>
            <div class="faq-items">
                <div class="faq-item">
                    <div class="faq-item-top">
                        <h1 class="faq-heading">o que é um banco de currículos?</h1>
                        <div class="faq-item-cross">
                            <div class="cross-line"></div>
                            <div class="cross-line"></div>
                        </div>
                    </div>
                    <div class="p-answer">
                        <p>Trata-se do armazenamento de informações e referências de possíveis candidatos para uma vaga.</p>
                        <p>Normalmente, é feito de forma digital, o que gera uma maior facilidade em acesso e controle de dados.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-item-top">
                        <h1 class="faq-heading">O que é a ETEC?</h1>
                        <div class="faq-item-cross">
                            <div class="cross-line"></div>
                            <div class="cross-line"></div>
                        </div>
                    </div>
                    <div class="p-answer">
                        <p>A Escola Técnica Estadual (ETEC) é um programa governamental que objetiva a formação de profissões de nível técnico.</p>
                        <p>Um grande benefício é a possibilidade de realizar o curso técnico durante o colégio.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-item-top">
                        <h1 class="faq-heading">Que cursos estão disponíveis na ETEC MCM?</h1>
                        <div class="faq-item-cross">
                            <div class="cross-line"></div>
                            <div class="cross-line"></div>
                        </div>
                    </div>
                    <div class="p-answer">
                        <p>Informática para Internet, Administração, Recursos Humanos e Química.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="./scripts/cursor.js"></script>
    <script src="./scripts/menu.js"></script>
    <script type="module" src="./scripts/main.js"></script>
</body>
</html>