<?php 
require_once ('class/produto.php');
require_once ('class/categoria.php');
require_once ('class/categoriaDAO.php');
require_once("cabecalho.php"); 
require_once("logica-usuario.php");
verificaUsuario();

$daocategoria = new CategoriaDAO($conexao);
$categorias = $daocategoria->listaCategorias();
$produtos = array();
$produto = new LivroFisico('','');
$categoria = new Categoria();
$categoria->setId('');
$produto->setCategoria($categoria);
$produto->setNome('');
$produto->setDescricao('');
$produto->setPreco('');
$usado = "";
?>

<h1>Formulário de cadastro</h1>
<form action="adiciona-produto.php" method="post">
    <table>
    <?php include("produto-formulario-base.php"); ?>
        
        <tr>
            <td><input class="btn btn-primary" type="submit" value="Cadastrar" /></td>
        </tr>

    </table>

</form>

<?php include("rodape.php"); ?>