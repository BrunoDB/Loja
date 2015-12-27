<?php
require_once("autoload.php");
require_once("conecta.php"); 
class ProdutoDAO 
{

    private $conexao;
    function __construct($conexao) {
        $this->conexao = $conexao;
    }
	function listaProdutos() {
		$produtos = array();
		$resultado = mysqli_query($this->conexao, "select p.*, c.nome as categoria_nome from produtos as p join categorias as c on p.categoria_id = c.id");
	
		while($produto_atual = mysqli_fetch_assoc($resultado)) {
			
			$tipoProduto = $produto_atual["tipoProduto"];
			$factory = new ProdutoFactory();    
			$produto = $factory->criaPor($tipoProduto, $produto_atual['nome'], $produto_atual['preco']);
			
			if (trim($produto_atual['isbn'])!=="") {
				//$produto = new Livro($produto_atual['nome'], $produto_atual['preco']);
				$produto->setIsbn($produto_atual['isbn']);
			} //else {
				//$produto = new Produto($produto_atual['nome'], $produto_atual['preco']);
			//}
						
			$categoria = new Categoria;
			$categoria->setNome($produto_atual['categoria_nome']);
			$categoria->setId($produto_atual['categoria_id']);
			$produto->setCategoria($categoria);
			$produto->setId($produto_atual['id']);
			$produto->setDescricao($produto_atual['descricao']);
			$produto->setUsado($produto_atual['usado']);
			//$produto->setTipoProduto($produto_atual['tipoProduto']);
            
			//$produto->setCategoria($produto_atual['categoria_nome']);
			array_push($produtos, $produto);
		}
	
		return $produtos;
	
	}
	
	function buscaProduto($produto) {
		$query = "select * from produtos where id = {$produto->getId()}";
		$resultado = mysqli_query($this->conexao, $query);
		$produto_atual = mysqli_fetch_assoc($resultado);
		
		
		$tipoProduto = $produto_atual["tipoProduto"];
		$factory = new ProdutoFactory();    
		$produto = $factory->criaPor($tipoProduto, $produto_atual['nome'], $produto_atual['preco']);
		if (trim($produto_atual['isbn'])!=="") {
			//$produto = new Livro($produto_atual['nome'], $produto_atual['preco']);
			$produto->setIsbn($produto_atual['isbn']);
		} //else {
			//$produto = new Produto($produto_atual['nome'], $produto_atual['preco']);
		//}
		
		$categoria = new Categoria();	
		$categoria->setId($produto_atual['categoria_id']);
		$produto->setCategoria($categoria);
		$produto->setId($produto_atual['id']);
		$produto->setDescricao($produto_atual['descricao']);
		$produto->setUsado($produto_atual['usado']);
		//$produto->setTipoProduto($produto_atual['tipoProduto']);
		return $produto;
	}
	
	function insereProduto($produto) {
		$nome = mysqli_real_escape_string($this->conexao, $produto->getNome());
		$preco = mysqli_real_escape_string($this->conexao, $produto->getPreco());
		$descricao = mysqli_real_escape_string($this->conexao, $produto->getDescricao());
		$categoria_id = mysqli_real_escape_string($this->conexao, $produto->getCategoria()->getId());
		$usado = mysqli_real_escape_string($this->conexao, $produto->getUsado());
		$tipoProduto = mysqli_real_escape_string($this->conexao, $produto->getTipoProduto());		
		/*if ($produto->temIsbn()) {
			$isbn = mysqli_real_escape_string($this->conexao, $produto->getIsbn());
		} else {
			$isbn = "";
		}*/
		$isbn = "";
		if(method_exists($produto, "getIsbn")) {
			$isbn = mysqli_real_escape_string($this->conexao, $produto->getIsbn());
		}
		$waterMark = "";
		if(method_exists($produto, "getWaterMark")) {
			$waterMark = mysqli_real_escape_string($this->conexao, $produto->getWaterMark());
		}
		$taxaImpressao = "";
		if(method_exists($produto, "getTaxaImpressao")) {
			$taxaImpressao = mysqli_real_escape_string($this->conexao, $produto->getTaxaImpressao());
		}
		$query = "insert into produtos (nome, preco, descricao, categoria_id, usado, isbn, tipoProduto,  waterMark, taxaImpressao) values ('{$nome}', {$preco}, '{$descricao}', {$categoria_id}, {$usado}, '{$isbn}', '{$tipoProduto}', '{$waterMark}', '{$taxaImpressao}')";
		$resultadoDaInsercao = mysqli_query($this->conexao, $query);
		return $resultadoDaInsercao;
	}
	
	function alteraProduto($produto) {
		$query = "update produtos set nome = '{$produto->getNome()}', preco = {$produto->getPreco()}, descricao = '{$produto->getDescricao()}', 
			categoria_id= {$produto->getCategoria()->getId()}, usado = {$produto->getUsado()} where id = '{$produto->getId()}'";
		return mysqli_query($this->conexao, $query);
	}
	
	function removeProduto($id) {
		$query = "delete from produtos where id = {$id}";
		return mysqli_query($this->conexao, $query);
	}

}
?>
