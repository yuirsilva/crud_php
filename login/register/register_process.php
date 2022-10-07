<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/db.php");
    include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/session.php");

    $namef = $_POST['name'];
    $email = strtolower($_POST['email']);
    $pass = $_POST['pass'];
    
    $e_pass = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 11]);

    $sql = "INSERT INTO users(namef, email, pass, typef) VALUES(:namef, :email, :e_pass, 1)";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':namef', $namef);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':e_pass', $e_pass);

    $result = $stmt->execute();

    if (!$result)
    {
        var_dump($stmt->errorInfo());
        exit;
    }

    $email !== NULL && $pass !== NULL && $stmt->rowCount() > 0 && exit(header('Location: ../login.php'));
?>