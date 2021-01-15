<?php
function lista_combo_cidades($id = null) {
    $output = '';
    $conn = mysqli_connect('localhost', 'root', '', 'livro');
    $query = 'SELECT id, nome FROM cidade';
    $result = mysqli_query($conn, $query);
    if($result) {
        while($row = mysqli_fetch_assoc($result)) {
            $check = ($row['id'] == $id)? 'selected=1' : '';
            $output .= "<option $check value='{$row['id']}'>{$row['nome']}</option>\n";
        }
    }
    mysqli_close($conn);
    return $output;
}