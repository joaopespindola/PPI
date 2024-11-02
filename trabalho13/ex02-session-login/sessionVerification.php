<?php

function exitWhenNotLoggedIn()
{ 
  // Redireciona o usuário para a página de login "index.html" se ele não estiver logado, "loggedIn" nao estiver definido
  if (!isset($_SESSION['loggedIn'])) {
    header("Location: index.html");
    exit();  
  }
}
