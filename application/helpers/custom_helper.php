<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function Debug($value){
        echo "<pre>";
        print_r($value);
        echo "</pre>";
    }

    function indate($dt){
        return date('d-M-Y H:i:s', strtotime($dt));
    }

    function set_to_post($data){
        foreach($data as $key => $value){
            $_POST[$key] = $value;
        }
    }