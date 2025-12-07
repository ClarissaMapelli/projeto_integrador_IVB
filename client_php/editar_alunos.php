<?php
$id = $_GET["id"] ?? null;
if (!$id) die("ID inválido.");

if ($_POST) {

    $data = json_encode($_POST);

    $res = file_get_contents(
        "http://localhost/projeto_api/api/alunos.php?id=$id",
        false,
        stream_context_create([
            "http" => [
                "method"  => "PUT",
                "header"  => "Content-Type: application/json",
                "content" => $data
            ]
        ])
    );

    echo "<pre>$res</pre>";
    echo '<a href="lista_alunos.php">Voltar para a lista</a>';
    exit;
}

// Carregar dados atuais
$dados = file_get_contents("http://localhost/projeto_api/api/alunos.php?id=$id");
$aluno = json_decode($dados, true);
?>

<h2>Editar Aluno</h2>

<form method="POST">

    Nome: <input type="text" name="nome" value="<?= $aluno["nome"] ?>"><br><br>

    Sobrenome: <input type="text" name="sobrenome" value="<?= $aluno["sobrenome"] ?>"><br><br>

    Email: <input type="email" name="email" value="<?= $aluno["email"] ?>"><br><br>

    Curso: <input type="text" name="curso" value="<?= $aluno["curso"] ?>"><br><br>

    Matrícula: <input type="text" name="matricula" value="<?= $aluno["matricula"] ?>"><br><br>

    <button type="submit">Salvar Alterações</button>
</form>

<br>
<a href="lista_alunos.php">Voltar</a>
