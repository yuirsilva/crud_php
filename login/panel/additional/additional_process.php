<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/session.php");
    include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/db.php");

    if($_SESSION['loggedIn'] !== true){ exit(header('Location: ../logout.php')); }

    $first_field = $_POST['first-field'];
    $register_type = $_POST['register-type'];

    $sql = "SELECT curriculum.id_curr FROM curriculum WHERE id_user = :id_user";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id_user', $_SESSION['id']);

    $result = $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $id_curr = $rows[0]['id_curr'];

    if ($register_type == 'educação' || $register_type == 'experiência profissional'):
        $start_date = $_POST['start-course-date'];
        $end_date = $_POST['end-course-date'];
    endif;

    if (!$result)
    {
        var_dump($stmt->errorInfo());
        exit;
    };

    switch ($register_type)
    {
        default:
            exit(header('Location: ../panel.php'));
            break;
        case 'habilidade':
            $ability_insert = "INSERT INTO abilities(ability, id_curr) VALUES(:ability, :id_curr)";
            $stmt = $PDO->prepare($ability_insert);
            $stmt->bindParam(':ability', $first_field);
            $stmt->bindParam(':id_curr', $id_curr);
    
            $result = $stmt->execute();
            break;
        case 'competência':
            $competence_insert = "INSERT INTO competences(competence, id_curr) VALUES(:competence, :id_curr)";
            $stmt = $PDO->prepare($competence_insert);
            $stmt->bindParam(':competence', $first_field);
            $stmt->bindParam(':id_curr', $id_curr);
    
            $result = $stmt->execute();
            break;
        case 'educação':
            $course = $_POST['course'];

            $education_insert = "INSERT INTO education(institution, course, startf, endf, id_curr) VALUES(:institution, :course, :startf, :endf, :id_curr)";
            $stmt = $PDO->prepare($education_insert);
            $stmt->bindParam(':institution', $first_field);
            $stmt->bindParam(':course', $course);
            $stmt->bindParam(':startf', $start_date);
            $stmt->bindParam(':endf', $end_date);
            $stmt->bindParam(':id_curr', $id_curr);
    
            $result = $stmt->execute();
            break;
        case 'experiência profissional':
            $company = $_POST['company'];

            $experience_insert = "INSERT INTO experience(occupation, company, startf, endf, id_curr) VALUES(:occupation, :company, :startf, :endf, :id_curr)";

            $stmt = $PDO->prepare($experience_insert);
            $stmt->bindParam(':occupation', $first_field);
            $stmt->bindParam(':company', $company);
            $stmt->bindParam(':startf', $start_date);
            $stmt->bindParam(':endf', $end_date);
            $stmt->bindParam(':id_curr', $id_curr);
    
            $result = $stmt->execute();
            break;
    }
    header('Location: ../panel.php');
?>