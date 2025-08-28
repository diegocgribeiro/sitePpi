<?php

require "sql/conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST["nome"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";
$data_agendamento = $_POST["data_agendamento"] ?? "";
$hora_agendamento = $_POST["hora_agendamento"] ?? "";
$mensagem = $_POST["mensagem"] ?? "";

try {
    $pdo->beginTransaction();
    $stmt1 = $pdo->prepare(
        <<<SQL
  INSERT INTO paciente (nome, email, telefone)
  VALUES (?, ?, ?)
  SQL
    );
    $stmt1->execute([$nome, $sexo, $email, $telefone]);
    $idNovoPaciente = $pdo->lastInsertId();
    $stmt2 = $pdo->prepare(
        <<<SQL
    INSERT INTO agendamento (datahora, codigomedico, codigopaciente)
    VALUES (?, ?, ?)
    SQL
    );
    $stmt2->execute([$data_agendamento, $cod_medico, $idNovoPaciente]);
    $pdo->commit();
    header("Location: mostra-agendamento.php");
} catch (Exception $e) {
    exit('Falha na transação: ' . $e->getMessage());
}

