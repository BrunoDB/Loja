<?php

class ProdutoFactory
{
	private $classes = array("Ebook", "LivroFisico");
    function criaPor($tipoProduto, $nome, $preco)
    {
        if (in_array($tipoProduto, $this->classes)) {
            return new $tipoProduto($nome, $preco);
        }
        return new LivroFisico($nome,$preco);
    }
}

?>