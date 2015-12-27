<?php 
require_once("autoload.php");
require_once("conecta.php"); 

function listaProdutos($conexao) {
    $produtos = array();
    $resultado = mysqli_query($conexao, "select p.*, c.nome as categoria_nome from produtos as p join categorias as c on p.categoria_id = c.id");

    while($produto_atual = mysqli_fetch_assoc($resultado)) {
        $produto = new Produto($produto_atual['nome'], $produto_atual['preco']);
		$categoria = new Categoria;
		$categoria->setNome($produto_atual['categoria_nome']);
		$categoria->setId($produto_atual['categoria_id']);
		$produto->setCategoria($categoria);
        $produto->setId($produto_atual['id']);
        $produto->setDescricao($produto_atual['descricao']);
        $produto->setUsado($produto_atual['usado']);
		//$produto->setCategoria($produto_atual['categoria_nome']);
		array_push($produtos, $produto);
    }

    return $produtos;

}

function buscaProduto($conexao, $produto) {
    $query = "select * from produtos where id = {$produto->getId()}";
    $resultado = mysqli_query($conexao, $query);
    $produto_atual = mysqli_fetch_assoc($resultado);
	$produto = new Produto($produto_atual['nome'],$produto_atual['preco']);
	$categoria = new Categoria();	
	$categoria->setId($produto_atual['categoria_id']);
	$produto->setCategoria($categoria);
	$produto->setId($produto_atual['id']);
	$produto->setDescricao($produto_atual['descricao']);
	$produto->setUsado($produto_atual['usado']);
	return $produto;
}

function insereProduto($conexao, $produto) {
	$nome = mysqli_real_escape_string($conexao, $produto->getNome());
	$preco = mysqli_real_escape_string($conexao, $produto->getPreco());
	$descricao = mysqli_real_escape_string($conexao, $produto->getDescricao());
	$categoria_id = mysqli_real_escape_string($conexao, $produto->getCategoria()->getId());
	$usado = mysqli_real_escape_string($conexao, $produto->getUsado());
    $query = "insert into produtos (nome, preco, descricao, categoria_id, usado) values ('{$nome}', {$preco}, '{$descricao}', {$categoria_id}, {$usado})";
    $resultadoDaInsercao = mysqli_query($conexao, $query);
    return $resultadoDaInsercao;
}

function alteraProduto($conexao, $produto) {
    $query = "update produtos set nome = '{$produto->getNome()}', preco = {$produto->getPreco()}, descricao = '{$produto->getDescricao()}', 
        categoria_id= {$produto->getCategoria()->getId()}, usado = {$produto->getUsado()} where id = '{$produto->getId()}'";
    return mysqli_query($conexao, $query);
}

function removeProduto($conexao, $id) {
    $query = "delete from produtos where id = {$id}";
    return mysqli_query($conexao, $query);
}