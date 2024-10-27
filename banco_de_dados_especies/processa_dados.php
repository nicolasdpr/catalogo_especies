<?php
date_default_timezone_set('America/Sao_Paulo');
// Verifica se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nomeEspecie = htmlspecialchars($_POST['inputTexto']);
    $observacao = htmlspecialchars($_POST['inputTexto2']);

    // Captura a data e a hora atuais
    $dataHora = date("d/m/Y H:i:s");

    // Cria o conteúdo da página HTML com a data e hora
    $conteudoHTML = "<!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <title>$nomeEspecie</title>
    </head>
    <body>
        <h1>$nomeEspecie</h1>
        <p><strong>Nome da Espécie:</strong> $nomeEspecie</p>
        <p><strong>Observação:</strong> $observacao</p>
        <p><strong>Data de Registro:</strong> $dataHora</p>
    </body>
    </html>";

    // Salva o arquivo HTML na pasta "dados_especies"
    $pastaDados = 'dados_especies/';
    $nomeArquivo = $pastaDados . strtolower(str_replace(' ', '_', $nomeEspecie)) . '.html';

    // Cria o diretório se não existir
    if (!is_dir($pastaDados)) {
        mkdir($pastaDados, 0777, true);
    }

    // Salva o conteúdo HTML em um arquivo
    file_put_contents($nomeArquivo, $conteudoHTML);

    // Redireciona para a página de listagem
    header("Location: listar_dados.php");
    exit;
}
?>
