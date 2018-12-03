<?php

    function vSenha($senha){
       if (is_numeric(filter_var($senha, FILTER_SANITIZE_NUMBER_INT))){
            if(preg_match("/[^[:punct:]]/", $senha) != 0){
                if(preg_match("/[^[:lower:]]/", $senha) != 0){
                    if(preg_match("/[^[:upper:]]/", $senha) != 0){
                        if(strlen($senha) >= 8 && strlen($senha) <= 12){
                            return 1;
                        }
                        return 0;
                    }
                    return 0;
                }
                return 0;
            }
           return 0;
       }
        return 0;
    }

?>