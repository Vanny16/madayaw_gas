<?php

function generateuuid()
    { 
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';

        for ($i = 0; $i < 32; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return $string;
    }

?>