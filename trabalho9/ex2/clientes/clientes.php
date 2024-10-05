<?php

class Cliente
{
  public $nome;
  public $cpf;
  public $email;
  public $senha;
  public $cep;
  public $endereco;
  public $bairro;
  public $cidade;
  public $telefone;

  function __construct($nome, $cpf, $email, $senha, $cep, $endereco, $bairro, $cidade, $telefone)
  {
    $this->nome = $nome;
    $this->cpf = $cpf;
    $this->email = $email;
    $this->senha = $senha;
    $this->cep = $cep;
    $this->endereco = $endereco;
    $this->bairro = $bairro;
    $this->cidade = $cidade;
    $this->telefone = $telefone;
  }

  public function SalvaEmArquivo()
  {
    // Abre o arquivo de texto para escrita de conteúdo no final
    $arq = fopen("clientes.txt", "a");

    // Neste exemplo os dados são armazenados de maneira simplificada,
    // no formato textual com campos separados por ponto-e-vírgula.
    fwrite($arq, "\n{$this->nome};{$this->cpf};{$this->email};{$this->senha};{$this->cep};{$this->endereco};{$this->bairro};{$this->cidade};{$this->telefone}");

    // Fecha o arquivo de texto.
    fclose($arq);
  }
}

// Carrega as informações dos clientes do arquivo de texto
// e retorna um array de objetos correspondente
function carregaClientesDeArquivo()
{
  $arrayClientes = [];

  // Abre o arquivo clientes.txt para leitura
  $arq = fopen("clientes.txt", "r");
  if (!$arq)
    return $arrayClientes;

  // Le os dados do arquivo, linha por linha, e armazena no vetor de clientes
  while (!feof($arq)) {
    // fgets lê uma linha de texto do arquivo
    $cliente = fgets($arq);

    // Separa dados na linha utilizando o ';' como separador
    list($nome, $cpf, $email, $senha, $cep, $endereco, $bairro, $cidade, $telefone) = array_pad(explode(';', $cliente), 9, null);

    // Cria novo objeto representado o cliente e adiciona no final do array
    $novoCliente = new Cliente($nome, $cpf, $email, $senha, $cep, $endereco, $bairro, $cidade, $telefone);
    $arrayClientes[] = $novoCliente;
  }

  // Fecha o arquivo
  fclose($arq);
  return $arrayClientes;
}
