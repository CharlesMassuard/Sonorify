<?php
    class Encrypteur {
        public static function encrypt($password) {
            return password_hash($password, PASSWORD_DEFAULT);
        }
    }
?>