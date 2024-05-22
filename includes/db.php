<?php

$db['db_host'] = "89.117.188.154";
$db['db_name'] = "u122608919_phpcms";
$db['db_user'] = "u122608919_phpcms";
$db['db_pass'] = "h/np>MEnG:1";

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// if($connection){
//     echo "We are connected";
// }

?>