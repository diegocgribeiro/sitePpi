<?php

require "sql/conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_GET["name"] ?? "";
$sexo = $_GET["sexo"] ?? "";
$email = $_GET["email"] ?? "";
$especialidade = $_GET["especialidade"] ?? "";
$nome_medico = $_GET["select-medico"] ?? "";
$telefone = $_GET["phone"] ?? "";
$data_agendamento = $_GET["date"] ?? "";
$hora = $_GET["time"] ?? "";
$mensagem = $_GET["mensagem"] ?? "";

try {
    $pdo->beginTransaction();
    $stmt1 = $pdo->prepare(
        <<<SQL
        INSERT INTO paciente (nome, sexo, email, telefone)
        VALUES (?, ?, ?, ?)
  SQL
    );
    $stmt1->execute([$nome, $sexo, $email, $telefone]);
    $idNovoPaciente = $pdo->lastInsertId();

    $codigo = $pdo->prepare(<<<SQL
                            select codigo from medico where nomeMed=?
                        SQL
    );
    $codigo->execute([$nome_medico]);
    $codigoMed = $codigo->fetchColumn();

    $stmt2 = $pdo->prepare(
        <<<SQL
            INSERT INTO agendamento (data_agendamento, hora, codigomedico, codigopaciente, mensagem)
            VALUES (?, ?, ?, ?, ?)
            SQL
    );

    $stmt2->execute([$data_agendamento, $hora, $codigoMed, $idNovoPaciente, $mensagem]);
    $pdo->commit();
    header("Location: agendamento.html");
    exit();

} catch (Exception $e) {
    $pdo->rollBack();
    exit('Falha na transação: ' . $e->getMessage());
}

