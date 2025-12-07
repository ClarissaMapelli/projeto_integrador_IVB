<?php
// Cabeçalhos CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

header("Content-Type: application/json; charset=UTF-8");

// BANCO SQLITE
$dbFile = __DIR__ . "/../db/alunos.db";
$db = new SQLite3($dbFile);

// TABELA
$db->exec("CREATE TABLE IF NOT EXISTS alunos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    sobrenome TEXT NOT NULL,
    email TEXT NOT NULL,
    curso TEXT NOT NULL,
    matricula TEXT NOT NULL,
    criado_em TEXT DEFAULT CURRENT_TIMESTAMP
);");

// RESPOSTA
function resposta($data, $codigo = 200) {
    http_response_code($codigo);
    echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;
}

if (isset($_SERVER["HTTP_X_HTTP_METHOD_OVERRIDE"])) {
    $_SERVER["REQUEST_METHOD"] = $_SERVER["HTTP_X_HTTP_METHOD_OVERRIDE"];
}

$metodo = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;

// GET
if ($metodo === 'GET') {

    if ($id) {
        $stmt = $db->prepare("SELECT * FROM alunos WHERE id = :id");
        $stmt->bindValue(":id", $id, SQLITE3_INTEGER);
        $resultado = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

        if (!$resultado) resposta(["erro" => "Aluno não encontrado"], 404);

        resposta($resultado);
    }

    $res = $db->query("SELECT * FROM alunos");
    $lista = [];
    while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
        $lista[] = $row;
    }
    resposta($lista);
}

// POST
if ($metodo === 'POST') {
    $dados = json_decode(file_get_contents("php://input"), true);

    if (!$dados || !isset($dados["nome"]) || !isset($dados["sobrenome"]) || !isset($dados["email"])) {
        resposta(["erro" => "Dados incompletos"], 400);
    }

    $stmt = $db->prepare("INSERT INTO alunos (nome, sobrenome, email, curso, matricula)
                          VALUES (:n, :s, :e, :c, :m)");

    $stmt->bindValue(":n", $dados["nome"]);
    $stmt->bindValue(":s", $dados["sobrenome"]);
    $stmt->bindValue(":e", $dados["email"]);
    $stmt->bindValue(":c", $dados["curso"]);
    $stmt->bindValue(":m", $dados["matricula"]);
    $stmt->execute();

    resposta(["mensagem" => "Aluno criado com sucesso"], 201);
}

// PUT
if ($metodo === 'PUT') {
    if (!$id) resposta(["erro" => "ID obrigatório"], 400);

    $dados = json_decode(file_get_contents("php://input"), true);

    $stmt = $db->prepare("UPDATE alunos SET
        nome = :n, sobrenome = :s, email = :e, curso = :c, matricula = :m
        WHERE id = :id");

    $stmt->bindValue(":n", $dados["nome"]);
    $stmt->bindValue(":s", $dados["sobrenome"]);
    $stmt->bindValue(":e", $dados["email"]);
    $stmt->bindValue(":c", $dados["curso"]);
    $stmt->bindValue(":m", $dados["matricula"]);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    resposta(["mensagem" => "Aluno atualizado"]);
}

// DELETE
if ($metodo === 'DELETE') {
    if (!$id) resposta(["erro" => "ID obrigatório"], 400);

    $stmt = $db->prepare("DELETE FROM alunos WHERE id = :id");
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    resposta(["mensagem" => "Aluno removido"]);
}

resposta(["erro" => "Método não suportado"], 405);
?>
