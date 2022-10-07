<?php
    include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/db.php");
    include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/session.php");

    $email = strtolower($_POST['email']);
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':email', $email);
    $result = $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // "->" is like "." in JavaScript, like: myObject.beautifulProp = 0xff0000
    //                                     myObject->beautifulProp = 0xff0000
    if($email !== NULL && $pass !== NULL)
    {
        if(is_array($rows))
        {
            if(password_verify($pass, $rows[0]['pass']))
            {
                // fetching the data
                $_SESSION['loggedIn'] = true;
                $_SESSION['id'] = $rows[0]['id'];
                $_SESSION['name'] = $rows[0]['namef'];
                $_SESSION['email'] = $rows[0]['email'];
                $_SESSION['cpf'] = $rows[0]['cpf'];
                $_SESSION['typef'] = $rows[0]['typef'];
                exit(header('Location: ./panel/panel.php'));
            }
        }
        header('Location: ./login.php');
    }
?>