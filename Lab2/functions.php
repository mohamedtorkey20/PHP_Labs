<?php

require_once "vendor/autoload.php";


function store_data($name, $email)
{
    $fp = fopen(FILE_NAME, "a+"); 
    $input = date("F j Y g:i a") .",".$_SERVER['REMOTE_ADDR'].",". $name . "," . "$email" ."\n"; 
    fwrite($fp, $input);
    fclose($fp);
}

function show_data($file_name)
{
    $data=file($file_name);

    foreach($data as $data_User)
    {
        return explode(",",$data_User);       
    }

}
?>
