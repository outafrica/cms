<?php

    $db['db_host'] = "localhost";
    $db['db_user'] = "uhiredev";
    $db['db_pass'] = "Uh1red@2020";
    $db['db_name'] = "cms";

    foreach($db as $key => $value){

        define(strtoupper($key), $value);

    }

    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if($connection){

        // echo "Successfully connected";

    }else {
        echo "Unable to connect";
    }





?>