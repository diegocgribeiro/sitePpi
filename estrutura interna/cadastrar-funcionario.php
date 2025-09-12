<?php
require "../sql/conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST['nome'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$dataNasc = $_POST['date'] ?? '';
$estadoCivil = $_POST['estadocivil'] ?? '';
$cargo = $_POST['cargo'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$hash = password_hash($senha, PASSWORD_DEFAULT);

try {
    $sql = "INSERT INTO funcionario (nome, CPF, datanascimento, estadocivil, funcao,  email, senhahash)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $pdo->beginTransaction();
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $cpf, $dataNasc, $estadoCivil, $cargo, $email, $hash ]);
    $pdo->commit();
    header("Location: listar-funcionarios.php");
} catch (Exception $e) {
    $pdo->rollBack();
    exit("Erro: " . $e->getMessage());
}
