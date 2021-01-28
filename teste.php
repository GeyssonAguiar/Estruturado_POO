<?php 

$teste = parse_ini_file('config/livro.ini');
foreach($teste as $linha) {
    print($linha . '<br>');
}



