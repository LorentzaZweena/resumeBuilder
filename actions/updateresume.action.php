<?php
    // session_start();
    require '../assets/class/databaseClass.php';
    require '../assets/class/function.class.php';
    if ($_POST){
        $post = $_POST;

        if($post['id'] && $post['slug'] && $post['full_name'] && $post['email_id'] && $post['objective'] && $post['mobile_no'] && $post['dob'] && $post['religion'] && $post['nationality'] && $post['marital_status'] && $post['hobbies'] && $post['languages'] && $post['address']){

            $columns = '';
            $values = '';
            $post2 = $post;
            
            unset($post2['id']);
            unset($post2['slug']);

            foreach($post2 as $index=>$value){
                $value = $db->real_escape_string($value);
                $columns .= $index."='$value',";
            }

            $authid = $fn->Auth()['id'];
            

            try{
                $query = "UPDATE resumes SET ";
                $query .= "$columns";
                $query .= "WHERE id={$post['id']} AND slug={$post['slug']}";

                $db->query($query);
                
                $fn->setAlert('Resume added!');
                $fn->redirect('../myresumes.php');

            } catch (Exception $error){
                $fn->setError($error->getMessage());
                $fn->redirect('../myresumes.php');
            }
        } else{
            $fn->setError('Unable to create resumes!');
            $fn->redirect('../myresumes.php');
        }
    }else{
        $fn->redirect('../myresumes.php');
    }
?>