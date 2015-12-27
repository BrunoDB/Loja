<?php 
require_once ('class/categoria.php');
require_once ('class/produto.php');
require_once ('class/produtoDAO.php');
require_once("cabecalho.php"); 
require_once("logica-usuario.php");
verificaUsuario();

$tipoProduto = $_POST["tipoProduto"];
$factory = new ProdutoFactory();    
$produto = $factory->criaPor($tipoProduto, $_POST["nome"],$_POST["preco"]);
$produto->atualizaBaseadoEm($_POST);

//if (strcasecmp($_POST["tipoProduto"], "livro") == 0) {
    //$produto = new Livro($_POST["nome"],$_POST["preco"]);
	
/*if (method_exists($produto, "setIsbn")) {
    $produto->setIsbn($_POST["isbn"]);
}
if (method_exists($produto, "setWaterMark")){
    $produto->setWaterMark($_POST["waterMark"]);
}
if (method_exists($produto, "setTaxaImpressao")) {
    $produto->setTaxaImpressao($_POST["taxaImpressao"]);
}*/

//} else {
    //$produto = new Produto($_POST["nome"],$_POST["preco"]);       
//}


$categoria = new Categoria();
$categoria->setId($_POST['categoria_id']);
$produto->setCategoria($categoria);
//$produto->setDescricao($_POST['descricao']);
if(array_key_exists('usado', $_POST)) {
    $usado = "true";
} else {
    $usado = "false";
}

$produto->setUsado($usado);
$produto->setTipoProduto($_POST['tipoProduto']);
//$produto->setIsbn($_POST['isbn']);

$dao = new ProdutoDAO($conexao);
if($dao->insereProduto($produto)) {
?>
<p class="text-success">Produto <?= $produto->getNome(); ?>, <?= $produto->getPreco(); ?> adicionado com sucesso!</p>
<?php
} else { 
$msg = mysqli_error($conexao);
?>
<p class="alert-danger">O produto <?= $produto->getNome(); ?> não foi adicionado: <?= $msg; ?></p>
<?php
}
?>
<?php include("rodape.php"); ?>