<?php

function resgataSenhaHashDoBD($email, $pdo) {
    // Configurações do banco de dados
    try {

        $sql = 'SELECT senhahash FROM funcionario WHERE email = ?';

        // Prepara a query
        $stmt = $pdo->prepare($sql);

        // Executa a query, passando o email do usuário
        $stmt->execute([$email]);

        // Busca o resultado (o hash da senha)
        $hash = $stmt->fetchColumn();

        // Retorna o hash (ou false se o usuário não for encontrado)
        return $hash;

    } catch (PDOException $e) {
        // Trata erros de conexão ou de query
        // Em um ambiente de produção, é melhor registrar o erro do que exibi-lo
        // para o usuário.
        echo 'Erro: ' . $e->getMessage();
        return false;
    }
}

require "sql/conexaoMysql.php";
$pdo = mysqlConnect();

$email = $_POST["email"] ?? "";
$senhaFornecida = $_POST["senha"] ?? "";


$senhaHashDoBD = resgataSenhaHashDoBD($email, $pdo);

if (password_verify($senhaFornecida, $senhaHashDoBD)) {
    // Login efetuado com sucesso!
    header('Location: estrutura interna/index.html');
    exit(); // Garante que o script será encerrado após o redirecionamento
} else {
    // Senha incorreta
    header('Location: login.html?erro=credenciais_invalidas');
    exit();
}