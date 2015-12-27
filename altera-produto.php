<?php 
require_once ('class/categoria.php');
require_once ('class/produto.php');
require_once ('class/produtoDAO.php');
require_once("cabecalho.php"); 

$produto = new Produto($_POST["nome"],$_POST["preco"]);
$categoria = new Categoria();
$categoria->setId($_POST['categoria_id']);
$produto->setCategoria($categoria);
$produto->setDescricao($_POST['descricao']);
$produto->setId($_POST['id']);

if(array_key_exists('usado', $_POST)) {
    $usado = "true";
} else {
    $usado = "false";
}

$produto->setUsado($usado);
$dao = new ProdutoDAO($conexao);
if($dao->alteraProduto($produto)) {
?>
<p class="text-success">Produto <?= $produto->getNome(); ?>, <?= $produto->getPreco(); ?> foi alterado.</p>
<?php
} else { 
$msg = mysqli_error($conexao);
?>
<p class="alert-danger">O produto <?= $produto->getNome(); ?> não foi alterado: <?= $msg; ?></p>
<?php
}
?>
<?php include("rodape.php"); ?>