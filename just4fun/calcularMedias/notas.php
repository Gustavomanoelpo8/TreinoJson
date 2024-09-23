<form action="notas.php" method="post">
    <label for="">digite o nome do aluno</label>
    <input type="text" name="nome" id="nome">
    <label for="">digite a nota do aluno</label>
    <input type="number" name="nota" id="nota">
    <button type="submit">enviar nota</button>
</form>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $nota = $_POST['nota'];

    $dados = array(
        'nome' => $nome,
        'nota' => (float)$nota
    );

    $arquivo = 'medias.json';

    if (file_exists($arquivo)) {

        $conteudo = file_get_contents($arquivo);
        $arrayGeral = json_decode($conteudo, true);

        foreach ($arrayGeral as $key => $value) {
            if ($value['nome'] == $nome) {
                unset($arrayGeral[$key]);
            }
        }
    } else {

        $arrayGeral = array();
    }

    $arrayGeral[] = $dados;

    $conteudoAtualizado = json_encode($arrayGeral, JSON_PRETTY_PRINT);
    file_put_contents($arquivo, $conteudoAtualizado);

    echo 'dados salvos com sucesso';
} else {
    echo 'metodo invalido';
}

