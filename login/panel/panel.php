<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/session.php");
    include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/db.php");

    if($_SESSION['loggedIn'] !== true){ exit(header('Location: ./logout.php')); }

    $sql = "SELECT * FROM curriculum WHERE id_user = :id_user";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id_user', $_SESSION['id']);
    $result = $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $resume_text = $resume_button_text = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="../../style/fonts.css">
    <link rel="stylesheet" href="../../style/reset.css">
    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="./panel.css">

    <!-- Icons -->
    <?php include_once($_SERVER['DOCUMENT_ROOT']."/fand/included/icon.php"); ?>
    
    <title>Dashboard | fand.</title>
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>

    <div class="cursor"></div>
    <main>
        <section class="main">
        <?php include_once('./menu.php'); ?>
            <div class="content">
                <div class="panel-mobile-menu">
                    <span>MENU</span>
                    <span>FECHAR</span>
                </div>
                <h1>Bem-vindo, <?= $_SESSION['name'] ?>!</h1>
                <?php if(!empty($rows)):
                        $phonenumber = $rows[0]['phonenumber'];
                        $course = $rows[0]['course'];

                        $resume_text = 'Atualizar currículo';

                        $resume_button_text = 'Você pode editar informações do seu currículo.';
                ?>
                    <div class="user-data">
                        <div class="information-block">
                            <div class="data-name">
                                <h4 class="data-h4">Nome</h4>
                                <h2 class="data-h2"><?= $_SESSION['name'] ?></h2>
                            </div>
                            <div class="data-email">
                                <h4 class="data-h4">Email</h4>
                                <h2 class="data-h2"><?= $_SESSION['email'] ?></h2>
                            </div>
                            <div class="data-phone-number">
                                <h4 class="data-h4">Telefone</h4>
                                <h2 class="data-h2"><?= $phonenumber ?></h2>
                            </div>
                            <div class="data-course">
                                <h4 class="data-h4">Curso</h4>
                                <h2 class="data-h2"><?= $course ?></h2>
                            </div>
                        </div>
                <?php else:
                    $resume_text = 'Cadastrar currículo';

                    $resume_button_text = 'Para ver novas informações, é necessário cadastrar um currículo.';
                ?>
                    <div class="user-data">
                        <div class="no-resume">
                            <h2>Primeira vez aqui? Para começar, cadastre seu currículo.</h2>
                            <img src="./img/notFound.svg" alt="Currículo não encontrado.">
                        </div>
                <?php endif; ?>
                        <a href="./resume/resume_register.php" class="resume-register">
                            <span><?= $resume_text ?></span>
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.9987 2.66666C8.63495 2.66666 2.66534 8.63599 2.66534 16C2.66534 23.364 8.63495 29.3333 15.9987 29.3333C23.3624 29.3333 29.332 23.364 29.332 16C29.332 8.63599 23.3624 2.66666 15.9987 2.66666ZM15.9987 5.33332C21.8897 5.33332 26.6654 10.1093 26.6654 16C26.6654 21.8907 21.8897 26.6667 15.9987 26.6667C10.1076 26.6667 5.33201 21.8907 5.33201 16C5.33201 10.1093 10.1076 5.33332 15.9987 5.33332Z" fill="black" fill-opacity="0.4"/>
                                <path d="M16 9.33334C15.2636 9.33334 14.6667 9.93068 14.6667 10.6667C14.6667 11.4027 15.2636 12 16 12C16.7364 12 17.3334 11.4027 17.3334 10.6667C17.3334 9.93068 16.7364 9.33334 16 9.33334ZM16 13.3333C15.2636 13.3333 14.6667 13.9307 14.6667 14.6667V21.3333C14.6667 22.0693 15.2636 22.6667 16 22.6667C16.7364 22.6667 17.3334 22.0693 17.3334 21.3333V14.6667C17.3334 13.9307 16.7364 13.3333 16 13.3333Z" fill="black"/>
                            </svg>
                            <div class="resume-info">
                                <p><?= $resume_button_text ?></p>
                            </div>
                        </a>
                    </div>


                <?php if(!empty($rows)):
                
                    $abilities = "SELECT abilities.id_abi, abilities.ability FROM abilities, curriculum WHERE curriculum.id_user = :id_user";

                    $stmt = $PDO->prepare($abilities);
                    $stmt->bindParam(':id_user', $_SESSION['id']);
                    $result = $stmt->execute();
                
                    $abilities_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                    <div class="abilities resume-additional">
                        <div class="information-block information-hover">
                            <?php if(empty($abilities_rows)): ?>
                                <h2>Hmm... Você não cadastrou nenhuma habilidade ainda...</h2>
                            <?php else:
                                foreach($abilities_rows as $ability)
                                {
                            ?>
                                <div data-id_abi="<?= $ability['id_abi'] ?>" class="ability">
                                    <div>
                                        <h4 class="data-h4">Habilidade</h4>
                                        <h2 class="data-h2"><?= $ability['ability'] ?></h2>
                                    </div>
                                </div>
                            <?php
                                }
                                endif;
                            ?>
                        </div>
                        <div class="resume-additional-btns-wrapper">
                            <a href="./additional/additional_resume_info.php?typeRegister=Habilidade" class="resume-additional-register">Cadastrar habilidade</a>
                            <button type="button">
                                <img src="./img/eyeClosed.svg" alt="Eye closed">
                            </button>
                            <button type="button" class="hide-eye">
                                <img src="./img/eyeOpened.svg" alt="Eye opened">
                            </button>
                        </div>
                    </div>

                    <?php
                        $competences = "SELECT competences.id_com, competences.competence FROM competences, curriculum WHERE curriculum.id_user = :id_user";

                        $stmt = $PDO->prepare($competences);
                        $stmt->bindParam(':id_user', $_SESSION['id']);
                        $result = $stmt->execute();
                        $competences_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                        <div class="competences resume-additional">
                            <div class="information-block information-hover">
                                <?php if(empty($competences_rows)): ?>
                                    <h2>Hmm... Você não cadastrou nenhuma competência ainda...</h2>
                                <?php else:
                                    foreach($competences_rows as $competence)
                                    {
                                ?>
                                    <div data-id_com="<?= $competence['id_com'] ?>" class="competence">
                                        <div>
                                            <h4 class="data-h4">Competência</h4>
                                            <h2 class="data-h2"><?= $competence['competence'] ?></h2>
                                        </div>
                                    </div>
                                <?php
                                    }
                                    endif;
                                ?>
                            </div>
                            <div class="resume-additional-btns-wrapper">
                                <a href="./additional/additional_resume_info.php?typeRegister=Competência" class="resume-additional-register">Cadastrar competência</a>
                                <button type="button">
                                    <img src="./img/eyeClosed.svg" alt="Eye closed">
                                </button>
                                <button type="button" class="hide-eye">
                                    <img src="./img/eyeOpened.svg" alt="Eye opened">
                                </button>
                            </div>
                        </div>

                    <?php
                        $educations = "SELECT education.id_edu, education.institution, education.course, education.startf, education.endf FROM education, curriculum WHERE curriculum.id_user = :id_user";

                        $stmt = $PDO->prepare($educations);
                        $stmt->bindParam(':id_user', $_SESSION['id']);
                        $result = $stmt->execute();
                        $educations_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                        <div class="educations resume-additional">
                            <div class="information-wrapper information-hover">
                                <?php if(empty($educations_rows)): ?>
                                    <h2>Hmm... Você não cadastrou nenhuma educação ainda...</h2>
                                <?php else:
                                    foreach($educations_rows as $education)
                                    {
                                ?>
                                    <div data-id_edu="<?= $education['id_edu'] ?>" class="information-block">
                                        <div>
                                            <div class="education-institution">
                                                <h4 class="data-h4">Instituição</h4>
                                                <h2 class="data-h2"><?= $education['institution'] ?></h2>
                                            </div>
                                            <div class="education-course">
                                                <h4 class="data-h4">Curso</h4>
                                                <h2 class="data-h2"><?= $education['course'] ?></h2>
                                            </div>
                                            <div class="education-start-data">
                                                <h4 class="data-h4">Início</h4>
                                                <h2 class="data-h2"><?= $education['startf'] ?></h2>
                                            </div>
                                            <div class="education-end-data">
                                                <h4 class="data-h4">Término</h4>
                                                <h2 class="data-h2"><?= $education['endf'] ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    }
                                    endif;
                                ?>
                            </div>
                            <div class="resume-additional-btns-wrapper">
                                <a href="./additional/additional_resume_info.php?typeRegister=Educação" class="resume-additional-register">Cadastrar educação</a>
                                <button type="button">
                                    <img src="./img/eyeClosed.svg" alt="Eye closed">
                                </button>
                                <button type="button" class="hide-eye">
                                    <img src="./img/eyeOpened.svg" alt="Eye opened">
                                </button>
                            </div>
                        </div>

                    <?php
                        $experiences = "SELECT experience.id_exp, experience.occupation, experience.company, experience.startf, experience.endf FROM experience, curriculum WHERE curriculum.id_user = :id_user";
                    
                        $stmt = $PDO->prepare($experiences);
                        $stmt->bindParam(':id_user', $_SESSION['id']);
                        $result = $stmt->execute();
                        $experiences_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                        <div class="professional-experiences resume-additional">
                            <div class="information-wrapper information-hover">
                                <?php if(empty($experiences_rows)): ?>
                                    <h2>Hmm... Você não cadastrou nenhuma experiência profissional ainda...</h2>
                                <?php else:
                                    foreach($experiences_rows as $experience)
                                    {
                                ?>
                                    <div data-id_exp="<?= $experience['id_exp'] ?>" class="information-block">
                                        <div>
                                            <div class="exp-company">
                                                <h4 class="data-h4">Empresa</h4>
                                                <h2 class="data-h2"><?= $experience['company'] ?></h2>
                                            </div>
                                            <div class="exp-occupation">
                                                <h4 class="data-h4">Ocupação</h4>
                                                <h2 class="data-h2"><?= $experience['occupation'] ?></h2>
                                            </div>
                                            <div class="exp-start-date">
                                                <h4 class="data-h4">Início</h4>
                                                <h2 class="data-h2"><?= $experience['startf'] ?></h2>
                                            </div>
                                            <div class="exp-end-date">
                                                <h4 class="data-h4">Término</h4>
                                                <h2 class="data-h2"><?= $experience['endf'] ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    }
                                    endif;
                                ?>
                            </div>
                            <div class="resume-additional-btns-wrapper">
                                <a href="./additional/additional_resume_info.php?typeRegister=Experiência profissional" class="resume-additional-register">Cadastrar experiência profissional</a>
                                <button type="button">
                                    <img src="./img/eyeClosed.svg" alt="Eye closed">
                                </button>
                                <button type="button" class="hide-eye">
                                    <img src="./img/eyeOpened.svg" alt="Eye opened">
                                </button>
                            </div>
                        </div>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <script src="../../scripts/cursor.js"></script>
    <script src="./panel.js"></script>
</body>
</html>