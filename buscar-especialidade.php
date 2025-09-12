<?php

require("sql/conexaoMysql.php");
$pdo = mysqlConnect();


try{
    $stmt = $pdo -> query(
        <<<SQL
        SELECT DISTINCT especialidade FROM medico
        SQL);
    
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $listaEspecialidades[] = $row;
    }
    echo json_encode($listaEspecialidades);
}catch(Exception $e){
    exit('Falha ao carregar'.$e->getMessage());
}