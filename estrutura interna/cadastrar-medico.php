<?php
require "../sql/conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST['nome'] ?? '';
$crm = $_POST['crm'] ?? '';
$especialidade = $_POST['especialidade'] ?? '';
try {

    $sql = "INSERT INTO medico (nomeMed, CRM, especialidade)
            VALUES (?, ?, ?)";
    $pdo->beginTransaction();
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $crm, $especialidade]);
    $pdo->commit();
    header("Location: listar-medicos.php");
} catch (Exception $e) {
    $pdo->rollBack();
    exit("Erro: " . $e->getMessage());
}
