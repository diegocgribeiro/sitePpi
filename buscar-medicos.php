<?php

require("sql/conexaoMysql.php");
$pdo = mysqlConnect();

$especialidade = $_GET["especialidade"] ?? "";

try{
    $stmt = $pdo -> prepare(
        <<<SQL
        SELECT nomeMed FROM medico WHERE especialidade=?
        SQL);
    $stmt->execute([$especialidade]);
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $listaDeMedicos[] = $row;
    }
    echo json_encode($listaDeMedicos);
}catch(Exception $e){
    exit('Falha ao carregar'.$e->getMessage());
}