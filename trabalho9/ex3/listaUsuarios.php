<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <!-- Tag de responsividade -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Página Dinâmica - Listagem de Usuários</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

  <div class="container">

    <h3>Usuarios Carregados do Arquivo <i>usuarios.txt</i></h3>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>E-mail</th>
          <th>Senha</th>
        </tr>
      </thead>

      <tbody>
        <?php
        require "usuarios.php"; // Inclui o arquivo da classe Usuario e funções

        // Carrega os usuarios do arquivo
        $arrayUsuarios = carregaUsuariosDeArquivo();

        // Percorre a lista de usuarios e exibe os dados em uma tabela
        foreach ($arrayUsuarios as $usuario) {
          /* O htmlspecialchars faz a conversão de caracteres especiais em entidades html
          evitando que o navegador confunda dados do usuário com código HTML */
          $email = htmlspecialchars($usuario->email);
          $senha = htmlspecialchars($usuario->senha);

          echo <<<HTML
            <tr>
              <td>$email</td>
              <td>$senha</td>
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