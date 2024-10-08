<?php

require "usuarios.php";

// coleta os dados do formulário
$email = $_POST["email"] ?? "";
$senha = $_POST["senha"] ?? "";
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

// cria um novo usuario e acrescenta no arquivo de texto
$novoUsuario = new Usuario($email, $senhaHash);
$novoUsuario->SalvaEmArquivo();

// redireciona o navegador para a página de listagem de usuarios
header("location: listaUsuarios.php");