<?php 
require_once("cabecalho.php"); 
require_once ('class/produtoDAO.php');
require_once("logica-usuario.php");

if(isset($_SESSION["success"])) { ?>
    <p class="alert-success"><?= $_SESSION["success"]?></p>
<?php 
	unset($_SESSION["success"]);
}
$dao = new ProdutoDAO($conexao);
$produtos = $dao->listaProdutos();
?>
<table class="table table-striped table-bordered">
<?php foreach($produtos as $produto) : ?>

    <tr>
        <td><?= $produto->getNome() ?></td>
        <td><?= $produto->getPreco() ?></td>
        <td><?= $produto->calculaImposto() ?></td>
        <td><?= substr($produto->getDescricao(), 0, 40) ?></td>
        <td> 
			<?php if($produto->temIsbn()): ?>
                ISBN: <?= $produto->getIsbn() ?>
            <?php endif ?> 
        </td>
        <td><?= $produto->getCategoria()->getNome() ?></td>
        <td><a class="btn btn-primary" href="produto-altera-formulario.php?id=<?=$produto->getId() ?>">alterar</a>
        </td>
        <td>
            <form method="post" action="remove-produto.php">
                <input type="hidden" name="id" value="<?=$produto->getId() ?>" />
                <button class="btn btn-danger">remover</button>            
            </form>
        </td>
    </tr>

<?php endforeach; ?>
</table>

<?php include("rodape.php"); ?>