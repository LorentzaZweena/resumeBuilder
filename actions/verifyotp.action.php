<?php
    // session_start();
    require '../assets/class/databaseClass.php';
    require '../assets/class/function.class.php';
    if ($_POST){
        $post = $_POST;

        if ($post['otp']){
            $otp = $post['otp'];
        
        if($fn->getSession('otp') == $otp){
            $fn->setAlert('Email is verified');
            $fn->redirect('../change-password.php');
        } else{
            $fn->setError('Incorrect code!');
            $fn->redirect('../verification.php');
        }
    }else{
        $fn->setError('Enter 6 digit code that sended to your email');
        $fn->redirect('../verification.php');
    }
}
?>