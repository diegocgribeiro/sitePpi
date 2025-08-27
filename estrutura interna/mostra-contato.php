<?php

require "../sql/conexaoMysql.php";
$pdo = mysqlConnect();

try {
  $stmt = $pdo->query(
    <<<SQL
    SELECT nome, email, telefone, mensagem, data_contato
    FROM contato
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
  <title>Mensagens de Contato</title>
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
    <a class="nav-link" href="listar-funcionarios.html">Funcionários</a>
    <a class="nav-link" href="listar-medicos.html">Médicos</a>
    <a class="nav-link" href="listar-agendamentos.html">Agendamentos</a>
    <a class="nav-link active" href="mostra-contato.php">Mensagens</a>
  </nav>

  <main class="container mt-4">
    <h2 class="text-center mb-4">Mensagens de Contato</h2>
    <div class="table-responsive">
      <table class="tabela">
        <thead>
          <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Mensagem</th>
            <th>Data do Contato</th>
          </tr>
        </thead>
        <?php
        while ($row = $stmt->fetch()) {
          $nome = htmlspecialchars($row['nome']);
          $email = htmlspecialchars($row['email']);
          $telefone = htmlspecialchars($row['telefone']);
          $mensagem = htmlspecialchars($row['mensagem']);
          $data_contato = htmlspecialchars($row['data_contato']);

          echo <<<HTML
        <tr>
          <td>$nome</td> 
          <td>$email</td>
          <td>$telefone</td>
          <td>$mensagem</td>
          <td>$data_contato</td>          
        </tr>      
        HTML;
        }
        ?>
      </table>
    </div>

</body>

</html>