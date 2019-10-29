<?php
    require 'vendor/autoload.php';

    $cliente = new MongoDB\Client("mongodb://localhost:27017");

    try{
        $dbs = $cliente->listDatabases();
    }catch(MongoDB\Driver\Exception\ConnectionTimeoutException $e){

    }

?>