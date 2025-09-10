<?php
require "conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST['nome'] ?? '';
$crm = $_POST['crm'] ?? '';
$especialidade = $_POST['especialidade'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$email = $_POST['email'] ?? '';

try {

    $sql = "INSERT INTO Medico (Nome, CRM, Especialidade, Telefone, Email)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $crm, $especialidade, $telefone, $email]);

    header("Location: listar-medicos.php");
} catch (Exception $e) {
    exit("Erro: " . $e->getMessage());
}
