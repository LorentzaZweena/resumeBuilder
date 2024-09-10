<?php
require '../assets/class/databaseClass.php';
require '../assets/class/function.class.php';

$db = new Database();
$fn = new functions();

if ($_POST) {
    $post = $_POST;
    if ($post['email_id'] && $post['password']) {
        $email_id = $db->real_escape_string($post['email_id']);
        $password = md5($db->real_escape_string($post['password']));
        
        $result = $db->query("SELECT id, full_name FROM users WHERE email_id='$email_id' AND password='$password'");
        $result = $result->fetch_assoc();

        if ($result) {
            header('Location: ../myresumes.php');
            exit();
        } else {
            header('Location: ../login.php');
            exit();
        }
    } else {
        header('Location: ../login.php');
        exit();
    }
}
?>
