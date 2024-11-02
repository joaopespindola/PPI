<?php

require "conexaoMysql.php";

$modelo = $_GET["modelo"];
$pdo = mysqlConnect();

$sql = <<<SQL
SELECT *
FROM veiculo
WHERE modelo = ?
SQL;

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$modelo]);
    if($stmt->rowCount() == 0)
        throw new Exception("Veiculo nao localizado");

    $veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($veiculos);
} catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}