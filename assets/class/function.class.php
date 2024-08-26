<?php
    class functions{
        public function redirect($address){
            header("Location:" .$address);
        }
    }
    $fn = new functions();
?>