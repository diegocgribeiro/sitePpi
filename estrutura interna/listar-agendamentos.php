<?php

require "sql/conexaoMysql.php";
$pdo = mysqlConnect();

try {
    $stmt = $pdo->query(
        <<<SQL
    SELECT p.nome , p.email, p.sexo , p.telefone, m.especialidade, a.data, a.hora, a.mensagem, m.nome as nome_medico
    FROM agendamento a, medico m, paciente p
    WHERE a.codigomedico = m.codigo AND a.codigopaciente = p.codigo
    SQL
    );
} catch (Exception $e) {
    exit('Falha ao executar declaração SQL: ' . $e->getMessage());
}

?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <!-- 1: Tag de responsividade -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tabela de agendamentos</title>

    <!-- 2: Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h3>Dados da tabela <b>agendamento</b></h3>
        <table class="table table-striped table-hover">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Sexo</th>
                <th>Telefone</th>
                <th>Data do agendamento</th>
                <th>Horário do agendamento</th>
                <th>Nome do médico</th>
                <th>Especialidade</th>
                <th>Mensagem</th>
            </tr>
            <?php
            while ($row = $stmt->fetch()) {
                $nome = htmlspecialchars($row['nome']);
                $email = htmlspecialchars($row['email']);
                $sexo = htmlspecialchars($row['sexo']);
                $telefone = htmlspecialchars($row['telefone']);
                $data = htmlspecialchars($row['data']);
                $hora = htmlspecialchars($row['hora']);
                $nome_medico = htmlspecialchars($row['nome_medico']);
                $especialidade = htmlspecialchars($row['especialidade']);
                $mensagem = htmlspecialchars($row['mensagem']);

                echo <<<HTML
        <tr>
          <td>$nome</td> 
          <td>$email</td>
          <td>$sexo</td>
          <td>$telefone</td>
          <td>$data</td>
          <td>$hora</td>
          <td>$nome_medico</td>
          <td>$especialidade</td>
          <td>$mensagem</td>
          
        </tr>      
        HTML;
            }
            ?>
        </table>

    </div>

</body>

</html>