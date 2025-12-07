<?php
$id = $_GET["id"] ?? null;
if (!$id) die("ID inválido.");

$res = file_get_contents(
    "http://localhost/projeto_api/api/alunos.php?id=$id",
    false,
    stream_context_create([
        "http" => [
            "method" => "DELETE"
        ]
    ])
);

echo "<pre>$res</pre>";
echo '<a href="lista_alunos.php">Voltar para lista</a>';
