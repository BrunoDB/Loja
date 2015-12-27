<?php 
require_once ('class/produto.php');
require_once ('class/produtoDAO.php');
require_once ('class/categoriaDAO.php');
require_once("cabecalho.php"); 

$produto = new Produto('','');
$produto->setId($_GET['id']);
$categoria = new Categoria;
$dao = new ProdutoDAO($conexao);
$produto = $dao->buscaProduto($produto);

$daocategoria = new CategoriaDAO($conexao);
$categorias = $daocategoria->listaCategorias();

$usado = $produto->getUsado() ? "checked='checked'" : "";
?>

<h1>Alterando produto</h1>
<form action="altera-produto.php" method="post">
	<input type="hidden" name="id" value="<?=$produto->getId() ?>" />
    <table>
    	<?php include("produto-formulario-base.php"); ?>
        
        
        <tr>
            <td><button class="btn btn-primary" type="submit">Alterar</button></td>
        </tr>

    </table>

</form>

<?php include("rodape.php"); ?>