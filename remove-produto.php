<?php 
require_once("logica-usuario.php");
require_once ('class/produtoDAO.php');

$id = $_POST['id'];
$dao = new ProdutoDAO($conexao);
$dao->removeProduto($id);
$_SESSION["success"] = "Produto removido com sucesso.";
header("Location: produto-lista.php");
die();