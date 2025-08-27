<?php

require "sql/conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST["nome"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";
$mensagem = $_POST["mensagem"] ?? "";
$data_contato = $_POST["data_contato"] ??"";

try {
    $pdo->beginTransaction();
    $stmt1 = $pdo->prepare(
        <<<SQL
  INSERT INTO contato (nome, email, telefone, mensagem, data_contato)
  VALUES (?, ?, ?, ?, ?)
  SQL
    );
    $stmt1->execute([$nome, $email, $telefone, $mensagem, $data_contato]);
    $pdo->commit();
    header("Location: contato.html");
} catch (Exception $e) {
    exit('Falha na transação: ' . $e->getMessage());
}

