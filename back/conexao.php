<?php
define('HOST','localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'cinif');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('não foi possivel conectar');
