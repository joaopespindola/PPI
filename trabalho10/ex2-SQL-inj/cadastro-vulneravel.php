<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

// Pega os dados do formulário
$nome = $_POST["nome"] ?? "";
$telefone = $_POST["telefone"] ?? "";

// Nova query SQL usando parâmetros em aberto (?) que serão inseridos posteriormente ao chamar o execute
$sql = <<<SQL
INSERT INTO aluno (nome, telefone)
VALUES (?, ?);
SQL;

try {

  /* NÃO FAÇA ISSO! Exemplo de código vulnerável a inj. de S-Q-L
  Faz a inserção de um novo aluno com os dados fornecidos pelo usuário sem nenhum tratativa dando brecha 
  para usuários mal intencionados rodarem suas consultas SQL diretamente no banco
  $sql = <<<SQL
  INSERT INTO aluno (nome, telefone)
  VALUES ('$nome', '$telefone');
  SQL;*/

  // Os dados dos parâmetros são passados separados da declaração do SQL, dessa forma cada método tem uma 
  // responsabilidade única, evitando que a entrada do usuário altere a estrutura do SQL
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$nome, $telefone]);

  // Experimente fazer o cadastro de um novo aluno preenchendo 
  // o campo telefone utilizando o texto disponibilizado pelo professor
  // nos slides de aula
  // $pdo->exec($sql);
  header("location: mostra-alunos.php");
  exit();
} catch (Exception $e) {
  exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
