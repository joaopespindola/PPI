<?php

class Usuario
{
  public $email;
  public $senha;

  function __construct($email, $senha)
  {
    $this->email = $email;
    $this->senha = $senha;
  }

  public function SalvaEmArquivo()
  {
    // Abre o arquivo de texto para escrita de conteúdo no final
    $arq = fopen("usuarios.txt", "a");

    // Neste exemplo os dados são armazenados de maneira simplificada,
    // no formato textual com campos separados por ponto-e-vírgula.
    fwrite($arq, "\n{$this->email};{$this->senha}");

    // Fecha o arquivo de texto.
    fclose($arq);
  }
}

// Carrega as informações dos usuarios do arquivo de texto
// e retorna um array de objetos correspondente
function carregaUsuariosDeArquivo()
{
  $arrayUsuarios = [];

  // Abre o arquivo usuarios.txt para leitura
  $arq = fopen("usuarios.txt", "r");
  if (!$arq)
    return $arrayUsuarios;

  // Le os dados do arquivo, linha por linha, e armazena no vetor de usuarios
  while (!feof($arq)) {
    // fgets lê uma linha de texto do arquivo
    $usuario = fgets($arq);

    // Separa dados na linha utilizando o ';' como separador
    list($email, $senha) = array_pad(explode(';', $usuario), 2, null);

    // Cria novo objeto representado o usuario e adiciona no final do array
    $novoUsuario = new Usuario($email, $senha);
    $arrayUsuarios[] = $novoUsuario;
  }

  // Fecha o arquivo
  fclose($arq);
  return $arrayUsuarios;
}

// Retorna a senha hash armazenada no arquivo pelo email passado
function resgataSenhaHashDoBD($email)
{
  $arrayUsuarios = carregaUsuariosDeArquivo();
  foreach ($arrayUsuarios as $usuario) {
    if ($usuario->email == $email) {
      return $usuario->senha;
    }
  }
}
