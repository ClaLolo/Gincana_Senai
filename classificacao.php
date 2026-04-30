<?php
$classificacao = [
    ["turma" => "2° EM", "pontos" => 3],
    ["turma" => "1° EM", "pontos" => 2],
    ["turma" => "9° ANO", "pontos" => 1],
    ["turma" => "3° EM", "pontos" => 0]
];
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

    <img src="img/Circuito SENAI.png" alt="Banner Circuito SENAI" class="top-banner">

    <header>
        <div class="logo">🏆 Circuito SENAI</div>
        <nav>
             <a href="index.html">início</a>
    <a href="#sobre">Sobre</a>
    <a href="#modalidades">Modalidades</a>
    <a href="#cronograma">Cronograma</a>
    <a href="jogos.php">Cadastrar Jogos</a>
    <a href="classificacao.php">Classificação</a>
        </nav>
    </header>

    <section class="sobre">
        <h2>Classificação das Turmas</h2>

        <table>
            <tr>
                <th>Posição</th>
                <th>Turma</th>
                <th>Pontos</th>
            </tr>

            <?php
            $posicao = 1;
            foreach ($classificacao as $time) {
                echo "
                <tr>
                    <td>{$posicao}º</td>
                    <td>{$time['turma']}</td>
                    <td>{$time['pontos']}</td>
                </tr>";
                $posicao++;
            }
            ?>
        </table>
    </section>

</body>
</html>