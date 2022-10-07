<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/db.php");
    include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/session.php");

    if($_SESSION['loggedIn'] !== true){ exit(header('Location: ../logout.php')); }

    $sql = "SELECT * FROM curriculum WHERE id_user = :id_user";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':id_user', $_SESSION['id']);
    $result = $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $phone = $_POST['phone'];
    $select = $_POST['course'];

    if(empty($rows)):
        $sql = "INSERT INTO curriculum(namef, email, phonenumber, course, id_user) VALUES(:namef, :email, :phonenumber, :course, :id_user)";
        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(':namef', $_SESSION['name']);
        $stmt->bindParam(':email', $_SESSION['email']);
        $stmt->bindParam(':phonenumber', $phone);
        $stmt->bindParam(':course', $select);
        $stmt->bindParam(':id_user', $_SESSION['id']);

        $result = $stmt->execute();

        if (!$result)
        {
            var_dump($stmt->errorInfo());
            exit;
        };

    else:
        $namef = $_POST['name'];
        $email = strtolower($_POST['email']);

        $sql = "UPDATE curriculum, users
        SET curriculum.namef = :namef,
            curriculum.email = :email,
            curriculum.phonenumber = :phonenumber,
            curriculum.course = :course,
            users.namef = :namef,
            users.email = :email
        WHERE
            curriculum.id_user = :id_user AND users.id = :id_user;";

        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(':namef', $namef);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phonenumber', $phone);
        $stmt->bindParam(':course', $select);
        $stmt->bindParam(':id_user', $_SESSION['id']);

        $result = $stmt->execute();

        if (!$result)
        {
            var_dump($stmt->errorInfo());
            exit;
        };

        $_SESSION['name'] = $namef;
        $_SESSION['email'] = $email;

    endif;
    $phone !== NULL && $select !== NULL && $stmt->rowCount() > 0 && exit(header('Location: ../panel.php'));
?>