<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function Debug()
{
    echo "<pre>";

    foreach (func_get_args() as $key => $debug_var) {
        $count = $key+1;

        if ($debug_var) {
            print_r($debug_var);
            echo "\n<br>";
        } else {
            echo "Debug Error: This {$count} argument has no value\n<br>";
        }
    }

    echo "</pre>";
}

function indate($dt)
{
    return date('d-M-Y H:i:s', strtotime($dt));
}

function set_to_post($data)
{
    foreach ($data as $key => $value) {
        $_POST[$key] = $value;
    }
}