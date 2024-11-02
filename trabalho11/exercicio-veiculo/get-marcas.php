<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

$sql = <<<SQL
SELECT DISTINCT marca 
FROM veiculo
SQL;

try {
    $stmt = $pdo->query($sql);
    $marcas = $stmt->fetchAll(PDO::FETCH_ASSOC);// Recupera todos os resultados da consulta em uma única chamada
    // "PDO::FETCH_ASSOC" para retornar os resultados em formato de array associativo
    echo json_encode($marcas);
} catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}