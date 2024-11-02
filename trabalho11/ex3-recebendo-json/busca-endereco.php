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

// Recebe o CEP informado pelo usuário
$cep = $_GET['cep'] ?? '';

// Verifica se o CEP informado pelo usuário é o correto
if ($cep == '38400-100')
  $endereco = new Endereco('Av Floriano', 'Centro', 'Uberlândia');
else if ($cep == '38400-200')
  $endereco = new Endereco('Rua Tiradentes', 'Fundinho', 'Uberlândia');
else {
  $endereco = new Endereco('', '', '');
}

header('Content-type: application/json');// Indica o tipo de resposta da requisição "application/json"
echo json_encode($endereco);
