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
                <th>Data de Registro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $pastaDados = 'dados_especies/';

            if (is_dir($pastaDados)) {
                if ($handle = opendir($pastaDados)) {
                    while (($arquivo = readdir($handle)) !== false) {
                        if ($arquivo !== '.' && $arquivo !== '..') {
                            $conteudo = file_get_contents("$pastaDados/$arquivo");

                            preg_match('/<strong>Nome da Espécie:<\/strong> (.+?)<\/p>/', $conteudo, $nome);
                            preg_match('/<strong>Observação:<\/strong> (.+?)<\/p>/', $conteudo, $observacao);
                            preg_match('/<strong>Data de Registro:<\/strong> (.+?)<\/p>/', $conteudo, $dataHora);

                            if (!empty($nome[1]) && !empty($observacao[1]) && !empty($dataHora[1])) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($nome[1]) . "</td>";
                                echo "<td>" . htmlspecialchars($observacao[1]) . "</td>";
                                echo "<td>" . htmlspecialchars($dataHora[1]) . "</td>";
                                echo "<td>
                                        <form action='deleta_dados.php' method='post' style='display:inline;'>
                                            <input type='hidden' name='arquivo' value='" . htmlspecialchars($arquivo) . "'>
                                            <button type='submit' onclick='return confirm(\"Tem certeza que deseja deletar esta espécie?\")'>Deletar</button>
                                        </form>
                                      </td>";
                                echo "</tr>";
                            }
                        }
                    }
                    closedir($handle);
                }
            } else {
                echo "<tr><td colspan='4'>Nenhuma espécie cadastrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="index.html">Novo cadastro</a> 
</body>
</html>
