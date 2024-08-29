<?php
    // session_start();
    require '../assets/class/databaseClass.php';
    require '../assets/class/function.class.php';
    if ($_POST){
        $post = $_POST;

        if($post['resume_id'] && $post['position'] && $post['company'] && $post['started'] && $post['ended'] && $post['job_desc']){
            $resumeid = array_shift($post);
            $columns = '';
            $values = '';

            foreach($post as $index=>$value){
                $value = $db->real_escape_string($value);
                $columns .= $index.',';
                $values .= "'$value',";
            }

            $columns .= 'resume_id';
            $values .= $resumeid;

            try{
                $query = "INSERT INTO resumes";
                $query .= "($columns)";
                $query .= "VALUES($values)";

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