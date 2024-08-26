<?php
    require '../assets/class/databaseClass.php';
    require '../assets/class/function.class.php';
    if ($_POST){
        $post = $_POST;
        if($post['full_name'] && $post['email_id'] && $post['password']){
            $full_name = $db->real_escape_string($post['full_name']);
            $email_id = $db->real_escape_string($post['email_id']);
            $password = md5($db->real_escape_string($post['password']));
            $db->query("SELECT COUNT(*) as users WHERE()")

            try{
                $db->query("INSERT INTO users(full_name, email_id, password) VALUES('$full_name', '$email_id', '$password')");
            } catch(Exception $error){
                echo $error->getMessage();
            }
        } else{
            $fn->redirect('../register.php');
        }
    }else{
        $fn->redirect('../register.php');
    }
?>