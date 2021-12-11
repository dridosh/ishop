<?php

    $config_user = 'root';
    $config_pass = '';
    $host = 'localhost';
    $dbname = 'fullstack';
    $port = 3306;

    $mysql = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $config_user, $config_pass);

    $exec = static function ($query, $data) use ($mysql) {
        $res = $mysql->prepare($query);
        $res->execute($data);
    };


    return [
        'mysql' => $mysql,
        'exec'  => $exec,
    ];