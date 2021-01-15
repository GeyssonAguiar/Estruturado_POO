<?php 

class Cidade 
{
    public static function all()
    {
        $conn = new PDO('mysql:host=localhost;dbname=livro', 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM cidade";
        $result = $conn->query($sql);
        return $result->fetchAll();
    }
}