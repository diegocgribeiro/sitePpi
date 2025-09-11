<?php
require "../php/conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST['nome'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$dataNasc = $_POST['date'] ?? '';
$estadoCivil = $_POST['estadocivil'] ?? '';
$cargo = $_POST['cargo'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$hash = password_hash($senha, PASSWORD_DEFAULT);

try {
    $sql = "INSERT INTO Funcionario (Nome, CPF, DataNascimento, EstadoCivil, Cargo, Telefone, Email, Senhahash)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $pdo->beginTransaction();
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $cpf, $dataNasc, $estadoCivil, $cargo, $telefone, $email, $hash]);
    $pdo->commit();
    header("Location: listar-funcionarios.php");
} catch (Exception $e) {
    $pdo->rollBack();
    exit("Erro: " . $e->getMessage());
}
