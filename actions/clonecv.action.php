<?php
    require '../assets/class/databaseClass.php';
    require '../assets/class/function.class.php';

    $slug = $_GET['resume'] ?? '';

    $resumes = $db->query("SELECT * FROM resumes WHERE (slug = '$slug' AND user_id=".$fn->Auth()['id'].") ");
    $resume = $resumes->fetch_assoc();
    if(!$resume){
        $fn->redirect('myresumes.php');
    }

    $exps = $db->query("SELECT * FROM experiences WHERE (".$resume['id'].") ");
    $exps = $exps->fetch_all(1);

    $edus = $db->query("SELECT * FROM educations WHERE (".$resume['id'].") ");
    $edus = $edus->fetch_all(1);

    $skills = $db->query("SELECT * FROM skills WHERE (".$resume['id'].") ");
    $skills = $skills->fetch_all(1);

    $columns = '';
    $values = '';

            foreach($resume as $index=>$value){
                $columns .= $index.',';
                $values .= "'$value',";
                unset($resume['id']);
            }

            $authid = $fn->Auth()['id'];
            $columns .= 'slug, updated_at, user_id';
            $values .= "'".$fn->randomstring()."',".time().",".$authid;

            try{
                $query = "INSERT INTO resumes";
                $query .= "($columns)";
                $query .= "VALUES($values)";

                $db->query($query);
                
                $fn->setAlert('Clone added!');
                $fn->redirect('../myresumes.php');

            } catch (Exception $error){
                $fn->setError($error->getMessage());
                $fn->redirect('../myresumes.php');
            }
?>