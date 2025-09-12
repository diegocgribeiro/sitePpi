<?php

require "sql/conexaoMysql.php";
$pdo = mysqlConnect();

$email = $_POST["email"] ?? "";

try {
    $sql = <<<SQL
        SELECT 
            p.nome, p.email, p.sexo, p.telefone,
            a.data_agendamento, a.hora, a.mensagem,
            m.nomeMed AS nome_medico, m.especialidade
        FROM agendamento a
        INNER JOIN paciente p ON a.codigopaciente = p.codigo
        INNER JOIN medico m ON a.codigomedico = m.codigo
        WHERE p.email = ?
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

} catch (Exception $e) {
    exit("Erro na consulta: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clínica F&G - Agendamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style_agendamento.css">
</head>

<body>
    <header>
        <div>
            <h3 class="central">Central de Atendimento: (34) 3232-3232</h3>
        </div>

        <nav class="navbar-custom">
            <div class="container">

                <a href="index.html" class="navbar-logo">
                    <img src="images/logo-sem-fundo.png" alt="Logo da Clínica">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

    </header>

    <body>


        <main class="container mt-4">
            <h2 class="text-center mb-4">Agendamentos F&G</h2>
            <div class="table-responsive">
                <table class="tabela">
                    <thead>
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
                    </thead>
                    <?php
                    while ($row = $stmt->fetch()) {
                    $nome = htmlspecialchars($row['nome']);
                    $email = htmlspecialchars($row['email']);
                    $sexo = htmlspecialchars($row['sexo']);
                    $telefone = htmlspecialchars($row['telefone']);
                    $data = htmlspecialchars($row['data_agendamento']);
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