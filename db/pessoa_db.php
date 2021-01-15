<?php 

function lista_pessoas() {
    $conn = mysqli_connect('localhost', 'root', '', 'livro');
    $result = mysqli_query($conn, "SELECT * FROM pessoa ORDER by id");
    $list = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $list;
}

function exclui_pessoa($id) {
    $conn = mysqli_connect('localhost', 'root', '', 'livro');
    $result = mysqli_query($conn, "DELETE FROM pessoa WHERE id= '{$id}'");
    mysqli_close($conn);
    return $result;
}

function get_pessoa($id) {
    $conn = mysqli_connect('localhost', 'root', '', 'livro');
    $result = mysqli_query($conn, "SELECT * FROM pessoa WHERE id= '{$id}'");
    $pessoa = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $pessoa;
}

function get_next_pessoa() {
    $conn = mysqli_connect('localhost', 'root', '', 'livro');
    $result = mysqli_query($conn, "SELECT max(id) as next FROM pessoa");
    $next = (int) mysqli_fetch_assoc($result)['next'] + 1;
    mysqli_close($conn);
    return $next;
}

function insert_pessoa($pessoa) {
    $conn = mysqli_connect('localhost', 'root', '', 'livro');
    $sql = "INSERT INTO pessoa (id, nome, endereco, bairro, telefone, email, id_cidade) 
    VALUES ( '{$pessoa['id']}', '{$pessoa['nome']}', '{$pessoa['endereco']}', '{$pessoa['bairro']}'
    ,'{$pessoa['telefone']}', '{$pessoa['email']}', '{$pessoa['id_cidade']}')";
    
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function update_pessoa($pessoa) {
    $conn = mysqli_connect('localhost', 'root', '', 'livro');
    $sql = "UPDATE pessoa SET nome = '{$pessoa['nome']}',
                              endereco = '{$pessoa['endereco']}',
                              bairro = '{$pessoa['bairro']}',
                              telefone = '{$pessoa['telefone']}',
                              email = '{$pessoa['email']}',
                              id_cidade = '{$pessoa['id_cidade']}'
                              WHERE id = '{$pessoa['id']}'";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}



