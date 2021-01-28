<?php 

class Pessoa 
{
    private static $conn;

    public static function getConnection() 
    
    {
        if (empty(self::$conn)) {
            $conexao = parse_ini_file( 'config/livro.ini');
            $host = $conexao['host'];
            $name = $conexao['name'];
            $user = $conexao['user'];
            

            self::$conn = new PDO("mysql:host={$host};dbname={$name}", "{$user}");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }

    public static function save($pessoa) 
    {
        $conn = self::getConnection();
        
        if(empty($pessoa['id'])) {
            $result = $conn->query("SELECT max(id) as next FROM pessoa");
            $row = $result->fetch();
            $pessoa['id'] = (int) $row['next'] + 1;
        
            $sql = "INSERT INTO pessoa (id, nome, endereco, bairro,
                                        telefone, email, id_cidade)
                                        VALUES ( :id, :nome, :endereco,
                                        :bairro, :telefone, :email,
                                        :id_cidade)";
        
        }else {
            $sql = "UPDATE pessoa SET nome = :nome, 
                                      endereco = :endereco, 
                                      bairro = :bairro,
                                      telefone = :telefone,
                                      email = :email, 
                                      id_cidade = :id_cidade
                                where id = :id";    
        }
        $result = $conn->prepare($sql);
        $result->execute([':id' => $pessoa['id'],
                          ':nome' => $pessoa['nome'],
                          ':endereco' => $pessoa['endereco'],
                          ':bairro' => $pessoa['bairro'],
                          ':telefone' => $pessoa['telefone'],
                          ':email' => $pessoa['email'],
                          ':id_cidade' => $pessoa['id_cidade'],
        ]);
    }

    public static function find($id) 
    
    {
        $conn = self::getConnection();

        $result = $conn->query("SELECT * FROM pessoa WHERE id = '{$id}'");
        return $result->fetch();
    }

    public static function delete($id)
    {
        $conn = self::getConnection();
       
        $sql = "DELETE FROM pessoa WHERE id = '{$id}'";
        return $conn->query($sql);
    }

    public static function all() 
    {
        $conn = self::getConnection();

        $sql = "SELECT * FROM pessoa ORDER BY id ";
        $result = $conn->query($sql);
        return $result->fetchAll();
    }
}