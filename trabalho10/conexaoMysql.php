<?php

function mysqlConnect()
{
  $db_host = "sql313.infinityfree.com";
  $db_username = "if0_37069041";
  $db_password = "OTU0EAk48caPloO";
  $db_name = "if0_37069041_ppi";

  $options = [
    PDO::ATTR_EMULATE_PREPARES => false, // desativa a execução emulada de prepared statements
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ];

  try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_username, $db_password, $options);
    return $pdo;
  } 
  catch (Exception $e) {
    exit('Ocorreu uma falha na conexão com o MySQL: ' . $e->getMessage());
  }
}
?>
