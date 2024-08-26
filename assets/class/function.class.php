<?php
    session_start();
    class functions{
        public function redirect($address){
            header("Location:" .$address);
        }

        public function setError($msg){
            $_SESSION['error'] = $msg;
        }

        public function error(){
            if(isset($_SESSION['error'])){
                echo "Swal.fire('', '".$_SESSION['error']."', 'error')";
                unset($_SESSION['error']);
            }
        }

        public function setAlert($msg){
            $_SESSION['alert'] = $msg;
        }

        public function alert(){
            if(isset($_SESSION['alert'])){
                echo "Swal.fire('', '".$_SESSION['alert']."', 'success')";
                unset($_SESSION['alert']);
            }
        }
    }
    $fn = new functions();
?>