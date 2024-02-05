<?php
function hashP($password){
    return password_hash($password, PASSWORD_DEFAULT);
}

print(hashP("LutinTag"));
print("\n");
?>