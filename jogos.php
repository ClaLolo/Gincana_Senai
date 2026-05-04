<?php
// define as turmas e as modalidades
$turmas = ["9° ANO", "1° EM", "2° EM", "3° EM"];

$modalidades = [
    "VOLEIBOL",
    "PEBOLIM",
    "CABO DE GUERRA",
    "PENALIDADES",
    "TÊNIS DE MESA",
    "EMBAIXADINHA",
    "CAMPO MINADO",
    "LANCE LIVRE",
    "QUEIMADA"
];

// nome do arquivo onde salva os jogos
$arquivo = "jogos.json";


// se o arquivo existir, pega os jogos
if (file_exists($arquivo)) {
    $jogos = json_decode(file_get_contents($arquivo), true);
} else {
    $jogos = []; // se não existir, começa vazio
}

$mensagem = ""; // mensagem que vai aparecer na tela


// quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // pega os dados do formulário
    $equipe1 = $_POST["equipe1"];
    $equipe2 = $_POST["equipe2"];
    $modalidade = $_POST["modalidade"];
    $vencedor = $_POST["vencedor"];

    // verifica se as equipes são iguais
    if ($equipe1 == $equipe2) {

        $mensagem = "As equipes não podem ser iguais!";

    } else {

        // cria um novo jogo
        $novoJogo = [
            "equipe1" => $equipe1,
            "equipe2" => $equipe2,
            "modalidade" => $modalidade,
            "vencedor" => $vencedor
        ];

        // adiciona na lista de jogos
        $jogos[] = $novoJogo;

        // salva no arquivo JSON
        file_put_contents(
            $arquivo,
            json_encode($jogos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );

        $mensagem = "Jogo cadastrado com sucesso!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"> <!-- acentos -->
    <title>Cadastro de Jogos</title>
    <link rel="stylesheet" href="jogos.css"> <!-- css -->
</head>
<body>

<!-- imagem de cima -->
<img src="img/Circuito SENAI.png" alt="" class="top-banner">

<!-- menu -->
<header class="header">
  <div class="logo"> Circuito SENAI</div>
  <nav class="menu">
    <a href="index.html">início</a>
    <a href="index.html#sobre">Sobre</a>
    <a href="index.html#modalidades">Modalidades</a>
    <a href="index.html#cronograma">Cronograma</a>
    <a href="jogos.php">Cadastrar Jogos</a>
    <a href="classificacao.php">Classificação</a>
  </nav>
</header>

<!-- formulário -->
<section class="card-box">
    <h2>Cadastro de Jogos</h2>

    <form method="POST" class="form-jogo">

        <label>Equipe 1</label>
        <select name="equipe1" required>
            <?php foreach ($turmas as $turma) echo "<option>$turma</option>"; ?> <!-- lista as turmas -->
        </select>

        <label>Equipe 2</label>
        <select name="equipe2" required>
            <?php foreach ($turmas as $turma) echo "<option>$turma</option>"; ?> <!-- lista as turmas -->
        </select>

        <label>Modalidade</label>
        <select name="modalidade" required>
            <?php foreach ($modalidades as $modalidade) echo "<option>$modalidade</option>"; ?> <!-- lista as modalidades -->
        </select>

        <label>Vencedor</label>
        <select name="vencedor" required>
            <?php foreach ($turmas as $turma) echo "<option>$turma</option>"; ?> <!-- lista as turmas -->
        </select>

        <button type="submit">Salvar Jogo</button>

        <!-- mostra a mensagem -->
        <?php if ($mensagem != "") echo "<p class='mensagem'>$mensagem</p>"; ?>
    </form>
</section>

<!-- tabela com os jogos -->
<section class="card-box">
    <h2>Jogos Cadastrados</h2>

    <table class="tabela-jogos">
        <tr>
            <th>Equipe 1</th>
            <th>Equipe 2</th>
            <th>Modalidade</th>
            <th>Vencedor</th>
        </tr>

        <?php
        // mostra todos os jogos cadastrados
        foreach ($jogos as $jogo) {
            echo "<tr>
                    <td>{$jogo['equipe1']}</td>
                    <td>{$jogo['equipe2']}</td>
                    <td>{$jogo['modalidade']}</td>
                    <td>{$jogo['vencedor']}</td>
                  </tr>";
        }
        ?>
    </table>
</section>

</body>
</html>