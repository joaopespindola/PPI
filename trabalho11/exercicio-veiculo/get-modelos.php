<?php

require "conexaoMysql.php";

$marca = $_GET["marca"];
$pdo = mysqlConnect();

$sql = <<<SQL
SELECT DISTINCT modelo 
FROM veiculo
WHERE marca = ?
SQL;

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$marca]);
    if($stmt->rowCount() == 0)
        throw new Exception("Modelo nao localizado");

    $modelos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($modelos);
} catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}
