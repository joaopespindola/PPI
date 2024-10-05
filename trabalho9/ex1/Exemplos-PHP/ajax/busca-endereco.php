<?php

class Endereco
{
  public $rua;
  public $bairro;
  public $cidade;

  function __construct($rua, $bairro, $cidade)
  {
    $this->rua = $rua;
    $this->bairro = $bairro;
    $this->cidade = $cidade;
  }
}

/* Operador null coalescing "??" verifica se a variável a esquerda existe e não é nula, caso
não exista, recebe o valor de uma string vazia, caso exista, recebe o valor da variável a esquerda*/
$cep = $_GET['cep'] ?? '';

if ($cep == '38400-100')
  $endereco = new Endereco('Av Floriano', 'Centro', 'Uberlândia');
else if ($cep == '38400-200')
  $endereco = new Endereco('Rua Tiradentes', 'Fundinho', 'Uberlândia');
else {
  $endereco = new Endereco('', '', '');
}

header('Content-type: application/json');
echo json_encode($endereco);