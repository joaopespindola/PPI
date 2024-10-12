<?php

class Produto
{

  // Método para criar a tabela no banco de dados
  static function CreateTable($pdo)
  {
    $sql = <<<SQL
    CREATE TABLE IF NOT EXISTS produto 
    (
    id INT AUTO_INCREMENT PRIMARY KEY,  
    nome_produto VARCHAR(100) NOT NULL, 
    marca VARCHAR(50) NOT NULL,         
    descricao TEXT                      
    );
    SQL;
    // Executando o SQL
    try {
      $pdo->exec($sql);
      echo "Tabela 'produto' criada com sucesso!";
    } catch (PDOException $e) {
      echo "Erro ao criar a tabela: " . $e->getMessage();
    }
  }

  // Verifica se a tabela ja está criada
  // Funções estáticas pertencem à própria classe e podem ser chamadas sem a necessidade de criar uma instância dessa classe
  static function tableExists($pdo, $tableName)
  {
    try {
      $result = $pdo->query("SELECT 1 FROM $tableName LIMIT 1");
      return $result !== false;
    } catch (Exception $e) {
      return false;
    }
  }

  // Método estático para criar um novo cliente por meio
  // da inserção na tabela 'cliente' do BD.
  // Métodos estáticos estão associados à classe em si, e não a uma instância.
  // No PHP devem ser chamados com a sintaxe: NomeDaClasse::NomeDoMétodoEstático
  static function Create($pdo, $nome_produto, $marca, $descricao)
  {
    self::CreateTable($pdo);

    // Neste caso é necessário utilizar prepared statements para prevenir
    // inj. de S Q L, pois temos parâmetros (dados do cliente) fornecidos pelo usuário.
    // Repare que a coluna Id foi omitida por ser do tipo auto_increment.
    $stmt = $pdo->prepare(
      <<<SQL
      INSERT INTO produto (nome_produto, marca, descricao)
      VALUES (?, ?, ?)
      SQL
    );

    // Executa a declaração preparada fornecendo valores aos parâmetros (pontos-de-interrogação)
    $stmt->execute([$nome_produto, $marca, $descricao]);

    // retorna o Id do novo cliente criado
    return $pdo->lastInsertId();
  }

  // Busca um cliente na tabela a partir do Id e retorna
  // os dados na forma de um objeto PHP.
  static function Get($pdo, $id)
  {
    $stmt = $pdo->prepare(
      <<<SQL
      SELECT id , nome_produto, marca, descrição
      FROM produto
      WHERE id = ?
      SQL
    );

    $stmt->execute([$id]);
    if ($stmt->rowCount() == 0)
      throw new Exception("Produto não localizado");

    $produto = $stmt->fetch(PDO::FETCH_OBJ);
    return $produto;
  }

  // Retorna os 30 clientes iniciais da tabela na forma de um array de objetos.
  static function GetFirst30($pdo)
  {
    // Neste exemplo não é necessário utilizar prepared statements
    // porque não há a possibilidade de inj. de S Q L, 
    // pois nenhum parâmetro do usuário é utilizado na query SQL. 
    $stmt = $pdo->query(
      <<<SQL
      SELECT id, nome_produto, marca, descricao
      FROM produto
      LIMIT 30
      SQL
    );

    // Resgata os dados dos clientes como um array de objetos
    $arrayProdutos = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $arrayProdutos;
  }

  // Método estático para excluir um cliente dado o seu Id
  public static function Remove($pdo, $id)
  {
    $sql = <<<SQL
    DELETE 
    FROM produto
    WHERE id = ?
    LIMIT 1
    SQL;

    // Necessário utilizar prepared statements devido ao 
    // parâmetro informado pelo usuário
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
  }
}
