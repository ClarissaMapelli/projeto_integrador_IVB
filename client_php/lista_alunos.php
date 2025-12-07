<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Alunos</title>
</head>
<body>

<h2>Lista de Alunos</h2>

<a href="cadastrar_alunos.php">+ Cadastrar Novo Aluno</a>
<br><br>

<?php
// =========================
// CONSUMIR A API
// =========================

$dados = file_get_contents("http://localhost/projeto_api/api/alunos.php");

$alunos = json_decode($dados, true);

// Verifica se retornou array válido
if (!is_array($alunos) || count($alunos) === 0) {
    echo "<p>Nenhum aluno cadastrado.</p>";
    exit;
}
?>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Curso</th>
        <th>Ações</th>
    </tr>

<?php foreach ($alunos as $a): ?>
    <tr>
        <td><?= $a["id"] ?></td>
        <td><?= $a["nome"] . " " . $a["sobrenome"] ?></td>
        <td><?= $a["email"] ?></td>
        <td><?= $a["curso"] ?></td>

        <td>
            <a href="ver_aluno.php?id=<?= $a['id'] ?>">Ver</a> |
            <a href="editar_alunos.php?id=<?= $a['id'] ?>">Editar</a> |
            <a href="deletar_aluno.php?id=<?= $a['id'] ?>" onclick="return confirm('Deseja realmente excluir?')">Deletar</a>
        </td>
    </tr>
<?php endforeach; ?>

</table>

</body>
</html>
