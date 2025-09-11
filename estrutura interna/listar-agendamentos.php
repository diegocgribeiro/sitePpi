<?php

require "../sql/conexaoMysql.php";
$pdo = mysqlConnect();

try {
    $stmt = $pdo->query(
        <<<SQL
    SELECT p.nome , p.email, p.sexo , p.telefone, m.especialidade, a.data_agendamento, a.hora, a.mensagem, m.nomeMed as nome_medico
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
    <title>Agendamentos F&G</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo-restrito.css">
    <!-- 2: Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <header class="head-top">

        <h1>
            <span class="d-none d-md-inline">Clínica Médica - Acesso Restrito</span>
            <span class="d-inline d-md-none"></span>
        </h1>

    </header>
    <nav class="navbar-clinica">
        <a class="nav-link" href="index.html">Início</a>
        <a class="nav-link" href="cadastrar-funcionario.html">Cadastrar Funcionário</a>
        <a class="nav-link" href="cadastrar-medico.html">Cadastrar Médico</a>
        <a class="nav-link" href="listar-funcionarios.php">Funcionários</a>
        <a class="nav-link" href="listar-medicos.php">Médicos</a>
        <a class="nav-link active" href="listar-agendamentos.php">Agendamentos</a>
        <a class="nav-link " href="mostra-contato.php">Mensagens</a>
    </nav>

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