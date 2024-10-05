<?php

require "usuarios.php";

$email = $_POST["email"] ?? "";
$senha = $_POST["senha"] ?? "";

// verifica se o usuario existe e se a senha esta correta
$senhaHash = resgataSenhaHashDoBD($email);
if (password_verify($senha, $senhaHash)) {
    header("location: sucesso.html");
} else {
    header("location: login.html");
}
