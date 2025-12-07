<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Aluno</title>
</head>
<body>

<h2>Cadastrar Aluno</h2>

<form method="POST" action="">
    <label>Nome:</label><br>
    <input type="text" name="nome" required><br><br>

    <label>Sobrenome:</label><br>
    <input type="text" name="sobrenome" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Curso:</label><br>
    <input type="text" name="curso" required><br><br>

    <label>Matrícula:</label><br>
    <input type="text" name="matricula" required><br><br>

    <button type="submit">Cadastrar</button>
</form>

<?php
if ($_POST) {

    // transforma os dados do formulário em JSON
    $data = json_encode($_POST);

    // envia para a API
    $response = file_get_contents(
        "http://localhost/projeto_api/api/alunos.php",
        false,
        stream_context_create([
            "http" => [
                "method"  => "POST",
                "header"  => "Content-Type: application/json",
                "content" => $data
            ]
        ])
    );

    echo "<pre>$response</pre>";
}
?>

</body>
</html>
