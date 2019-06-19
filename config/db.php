<?php
$url = parse_url(getenv("DATABASE_URL"));
$dsn = 'pgsql:host='.$url['host'].';port='.$url['port'].';dbname='.substr($url["path"], 1);
$username = $url["user"];
$password = $url["pass"];
return [

//    'class' => 'yii\db\Connection',
//    'dsn' => "mysql:host=localhost;dbname=notebook",
//    'username' => 'root',
//    'password' => 'lesclaypool',
//    'charset' => 'utf8',

    'class' => 'yii\db\Connection',
    'dsn' => $dsn,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
