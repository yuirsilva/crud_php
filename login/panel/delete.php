<?php
    function delete()
    {
        include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/session.php");
        include_once($_SERVER['DOCUMENT_ROOT']."/fand/db/db.php");

        if($_SESSION['loggedIn'] !== true){ exit(header('Location: ./logout.php')); }

        $attrName = $_POST['attrName'];
        $attrValue = $_POST['attrValue'];
    
        $trim = substr($attrName, 5);
        echo $trim;

        $table = null;
        switch($trim)
        {
            default:
                exit(header('Location: ./panel.php'));
                break;
            case 'id_abi':
                $table = 'abilities';
                break;
            case 'id_com':
                $table = 'competences';
                break;
            case 'id_edu':
                $table = 'education';
                break;
            case 'id_exp':
                $table = 'experience';
                break;
        }
    
        $sql = "DELETE FROM $table WHERE $trim = :$trim";
    
        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(":$trim", $attrValue);
    
        $result = $stmt->execute();
    
        if (!$result)
        {
            var_dump($stmt->errorInfo());
            exit;
        }
    }
    delete();
?>