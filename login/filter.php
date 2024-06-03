<?php
    function filter($username_registry){
        // ^ inicio [a-zA-z] que filtra + indica 1 o mas caracteres $ final 
        if (!preg_match("/^[a-zA-Z]+$/", $username_registry[0])){
            echo "Write only letters"; // Solo para depuración, eliminar en producción
            return false;
        }

        return true;
    }
