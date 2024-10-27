<?php
// Verifica se o nome do arquivo foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['arquivo'])) {
    $pastaDados = 'dados_especies/';
    $arquivo = basename($_POST['arquivo']); // Utiliza basename para evitar manipulação de caminho
    $caminhoArquivo = $pastaDados . $arquivo;

    // Verifica se o arquivo existe e o deleta
    if (file_exists($caminhoArquivo)) {
        unlink($caminhoArquivo); // Deleta o arquivo
        echo "<script>alert('Espécie deletada com sucesso!'); window.location.href='listar_dados.php';</script>";
    } else {
        echo "<script>alert('Arquivo não encontrado!'); window.location.href='listar_dados.php';</script>";
    }
} else {
    echo "<script>alert('Nenhum arquivo especificado!'); window.location.href='listar_dados.php';</script>";
}
?>
