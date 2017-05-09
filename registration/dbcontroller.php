<?php



function Connection(){

    $server="localhost";
    $user="root";
    $pass="root";
    $db="medical_system";

    $connection = mysqli_connect($server, $user, $pass);

    if (!$connection) {
        die('MySQL ERROR: ' . mysqli_connect_error());
    }

    mysqli_select_db($connection,$db) or die( 'MySQL ERROR: '. mysqli_connect_error() );

    return $connection;
}

?>