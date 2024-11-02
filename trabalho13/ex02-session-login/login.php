<?php

require "conexaoMysql.php";

class LoginResult
{
  public $success;
  public $newLocation;

  function __construct($success, $newLocation)
  {
    $this->success = $success;
    $this->newLocation = $newLocation;
  }
}

function checkUserCredentials($pdo, $email, $senha)
{
  $sql = <<<SQL
    SELECT senhaHash
    FROM cliente
    WHERE email = ?
    SQL;

  try {
    // É necessário utilizar prepared statements por incluir
    // parâmetros informados pelo usuário
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $senhaHash = $stmt->fetchColumn();

    if (!$senhaHash) 
      return false; // a consulta não retornou nenhum resultado (email não encontrado)

    if (!password_verify($senha, $senhaHash))
      return false; // email e/ou senha incorreta
      
    // email e senha corretos
    return true;
  } 
  catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
  }
}

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$pdo = mysqlConnect();
if (checkUserCredentials($pdo, $email, $senha)) {
  // Define o parâmetro 'httponly' para o cookie de sessão, para que o cookie
  // possa ser acessado apenas pelo navegador nas requisições http (e não por código JavaScript).
  // Aumenta a segurança evitando que o cookie de sessão seja roubado por eventual
  // código JavaScript proveniente de ataq. X S S.
  $cookieParams = session_get_cookie_params();// Função que retorna um array com os parâmetros do cookie de sessão
  $cookieParams['httponly'] = true;// Define o parâmetro "httponly" como true
  session_set_cookie_params($cookieParams);// Define os parâmetros do cookie de sessão
  
  session_start();// Cria uma nova sessão
  $_SESSION['loggedIn'] = true;// Define a variável de sessão loggedIn como true para ter o controle na "exitWhenNotLoggedIn()"
  $_SESSION['user'] = $email;
  $response = new LoginResult(true, 'home.php');// Define o parâmetro "newLocation" como "home.php" e o "success" como true
} 
else
  $response = new LoginResult(false, '');// Define o parâmetro "newLocation" como "" para não redirecionar a página e o "success" como false

header('Content-Type: application/json; charset=utf-8');
echo json_encode($response);