<?php
    // session_start();
    require '../assets/class/databaseClass.php';
    require '../assets/class/function.class.php';
    if ($_GET){
        $post = $_GET;

        if($post['id'] && $post['resume_id']){
            
            try{
                $query = "DELETE FROM experiences WHERE id={$post['id']} AND resume_id={$post['resume_id']}";

                $db->query($query);
                
                $fn->setAlert('Experience deleted!');
                $fn->redirect('../updateresume.php?resume=id'.$post['slug']);

            } catch (Exception $error){
                $fn->setError($error->getMessage());
                $fn->redirect('../updateresume.php?resume=id'.$post['slug']);;
            }
        } else{
            $fn->setError('Unable to update resumes!');
            $fn->redirect('../updateresume.php?resume=id'.$post['slug']);
        }
    }else{
        $fn->redirect('../updateresume.php?resume=id'.$post['slug']);
    }
?>