<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <!-- Tag de responsividade -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Página Dinâmica - Listagem de Clientes</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>

  <div class="container">

    <h3>Clientes Carregados do Arquivo <i>clientes.txt</i></h3>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nome</th>
          <th>CPF</th>
          <th>E-mail</th>
          <th>Senha</th>
          <th>CEP</th>
          <th>Endereço</th>
          <th>Bairro</th>
          <th>Cidade</th>
          <th>Telefone</th>
        </tr>
      </thead>

      <tbody>
        <?php
        require "clientes.php"; // Inclui o arquivo da classe Cliente e funções

        // Carrega os clientes do arquivo
        $arrayClientes = carregaClientesDeArquivo();

        // Percorre a lista de clientes e exibe os dados em uma tabela
        foreach ($arrayClientes as $cliente) {
          /* O htmlspecialchars faz a conversão de caracteres especiais em entidades html
          evitando que o navegador confunda dados do usuário com código HTML */
          $nome = htmlspecialchars($cliente->nome);
          $cpf = htmlspecialchars($cliente->cpf);
          $email = htmlspecialchars($cliente->email);
          $senha = htmlspecialchars($cliente->senha);
          $cep = htmlspecialchars($cliente->cep);
          $endereco = htmlspecialchars($cliente->endereco);
          $bairro = htmlspecialchars($cliente->bairro);
          $cidade = htmlspecialchars($cliente->cidade);
          $telefone = htmlspecialchars($cliente->telefone);

          echo <<<HTML
            <tr>
              <td>$nome</td>
              <td>$cpf</td>
              <td>$email</td>
              <td>$senha</td>
              <td>$cep</td>
              <td>$endereco</td>
              <td>$bairro</td>
              <td>$cidade</td>
              <td>$telefone</td>
            </tr>
          HTML;
        }
        ?>
      </tbody>
    </table>
    <a href="index.html">Voltar à página inicial</a>
  </div>

</body>

</html>