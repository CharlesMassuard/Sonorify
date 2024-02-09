<?php
    namespace Data;

    class Encrypteur{
        public static function encrypt($password) {
            return hash("sha256", $password);
        }
    }
?>
