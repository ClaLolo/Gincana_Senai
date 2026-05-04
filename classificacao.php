<?php
// pega o arquivo onde estão os jogos
$arquivo = "jogos.json";

$jogos = []; // começa vazio

// se o arquivo existir, pega os dados dele
if (file_exists($arquivo)) {
    $jogos = json_decode(file_get_contents($arquivo), true);
}


// aqui começa a classificação com tudo zerado
$classificacao = [
    ["turma" => "9° ANO", "pontos" => 0],
    ["turma" => "1° EM", "pontos" => 0],
    ["turma" => "2° EM", "pontos" => 0],
    ["turma" => "3° EM", "pontos" => 0]
];


// passa por todos os jogos
foreach ($jogos as $jogo) {

    // passa por cada turma
    foreach ($classificacao as &$time) {

        // se a turma ganhou, ganha 3 pontos
        if ($time["turma"] == $jogo["vencedor"]) {
            $time["pontos"] += 3;
        }

    }

}


// organiza do maior pro menor (quem tem mais ponto fica em cima)
usort($classificacao, function($a, $b){
    return $b["pontos"] - $a["pontos"];
});

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Classificação</title>
    <link rel="stylesheet" href="classificacao.css">
</head>
<body>

    <!-- imagem de cima -->
    <img src="img/Circuito SENAI.png" alt="Banner Circuito SENAI" class="top-banner">

    <!-- menu -->
    <header>
        <div class="logo"> Circuito SENAI</div>
        <nav>
          <a href="index.html">início</a>
          <a href="index.html#sobre">Sobre</a>
          <a href="index.html#modalidades">Modalidades</a>
          <a href="index.html#cronograma">Cronograma</a>
          <a href="jogos.php">Cadastrar Jogos</a>
          <a href="classificacao.php">Classificação</a>
        </nav>
    </header>

    <!-- parte da tabela -->
    <section class="sobre">
        <h2>Classificação das Turmas</h2>

        <table>
            <tr>
                <th>Posição</th>
                <th>Turma</th>
                <th>Pontos</th>
            </tr>

            <?php
            $posicao = 1; // começa do 1

            // mostra as turmas na ordem
            foreach ($classificacao as $time) {
                echo "
                <tr>
                    <td>{$posicao}º</td> <!-- posição -->
                    <td>{$time['turma']}</td> <!-- nome -->
                    <td>{$time['pontos']}</td> <!-- pontos -->
                </tr>";
                $posicao++; // vai aumentando
            }
            ?>
        </table>
    </section>

</body>
</html>