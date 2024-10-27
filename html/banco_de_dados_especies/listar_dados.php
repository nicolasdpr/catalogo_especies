<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Espécies Cadastradas</title>
</head>
<body>
    <h1>Espécies Cadastradas</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nome da Espécie</th>
                <th>Observação</th>
                           </tr>
        </thead>
        <tbody>
            <?php
            $pastaDados = 'dados_especies/';

            // Verifica se a pasta existe
            if (is_dir($pastaDados)) {
                // Abre a pasta
                if ($handle = opendir($pastaDados)) {
                    // Itera por cada arquivo na pasta
                    while (($arquivo = readdir($handle)) !== false) {
                        // Ignora "." e ".."
                        if ($arquivo !== '.' && $arquivo !== '..') {
                            // Lê o conteúdo do arquivo HTML
                            $conteudo = file_get_contents("$pastaDados/$arquivo");

                            // Extraindo dados da espécie
                            preg_match('/<strong>Nome da Espécie:<\/strong> (.+?)<\/p>/', $conteudo, $nome);
                            preg_match('/<strong>Observação:<\/strong> (.+?)<\/p>/', $conteudo, $observacao);
                           

                            // Prepara a linha da tabela
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($nome[1]) . "</td>";
                            echo "<td>" . htmlspecialchars($observacao[1]) . "</td>";
                            echo "</tr>";

                            
                        }
                    }
                    closedir($handle);
                }
            } else {
                echo "<tr><td colspan='3'>Nenhuma espécie cadastrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href = "index.html"> Novo cadastro                 
</a> 
</body>
</html>
