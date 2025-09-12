<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listar Funcionários</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo-restrito.css">
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
        <a class="nav-link active" href="listar-funcionarios.php">Funcionários</a>
        <a class="nav-link" href="listar-medicos.php">Médicos</a>
        <a class="nav-link" href="listar-agendamentos.php">Agendamentos</a>
        <a class="nav-link" href="mostra-contato.php">Mensagens</a>
    </nav>

    <main class="container mt-4">
        <h2 class="mb-4">Funcionários cadastrados</h2>
        <div class="table-responsive">
            <table class="tabela">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>SenhaHash</th>
                        <th>Estado Civil</th>
                        <th>Data de Nascimento</th>
                        <th>Funcao</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require "../sql/conexaoMysql.php";
                    $pdo = mysqlConnect();
                    try {
                        $sql = "SELECT codigo, nome, email, senhahash, estadocivil, datanascimento, funcao FROM funcionario";
                        $stmt = $pdo->query($sql);
                        while ($row = $stmt->fetch()) {
                            $codigo = htmlspecialchars($row['codigo']);
                            $nome = htmlspecialchars($row['nome']);
                            $email = htmlspecialchars($row['email']);
                            $senhahash = htmlspecialchars($row['senhahash']);
                            $estadocivil = htmlspecialchars($row['estadocivil']);
                            $datanascimento = htmlspecialchars($row['datanascimento']);
                            $funcao = htmlspecialchars($row['funcao']);

                            echo <<<HTML
                            <tr>
                                <td>$codigo</td>
                                <td>$nome</td>
                                <td>$email</td>
                                <td>$senhahash</td>
                                <td>$estadocivil</td>
                                <td>$datanascimento</td>
                                <td>$funcao</td>
                            </tr>
                            HTML;
                        }
                    } catch (Exception $e) {
                        exit("Erro: " . $e->getMessage());
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer class="bg-light text-center p-3 mt-4">
        <small>© Clínica Médica - Sistema Interno</small>
    </footer>
</body>

</html>