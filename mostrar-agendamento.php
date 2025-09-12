<?php


require "sql/conexaoMysql.php";
$pdo = mysqlConnect();

$codigopaciente = $_POST["codigopaciente"] ?? "";

try{
    $stmt = $pdo -> prepare(
        <<<SQL
        SELECT * FROM agendamento WHERE codigopaciente=?
        SQL);
    $stmt->execute([$codigopaciente]);
    if ($stmt->rowCount() > 0) {
        echo "<h2>Agendamentos encontrados:</h2>";
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr>";

        // Cabeçalhos da tabela
        $colunas = array_keys($stmt->fetch(PDO::FETCH_ASSOC));
        foreach ($colunas as $coluna) {
            echo "<th>" . htmlspecialchars($coluna) . "</th>";
        }
        echo "</tr>";

        // Volta o ponteiro e imprime os dados
        $stmt->execute([$codigopaciente]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            foreach ($row as $valor) {
                echo "<td>" . htmlspecialchars($valor) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Nenhum agendamento encontrado.</p>";
    }
}
catch (Exception $e) {
    exit("Erro na consulta: " . $e->getMessage());
}
?>

