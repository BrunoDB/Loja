<?php 
abstract class Livro extends Produto
{
	private $isbn;
	function getIsbn()
	{
		return $this->isbn;
	}
	function setIsbn($isbn)
	{
		$this->isbn = $isbn;
	}
	
	function calculaImposto()
    {
        //return $this->getPreco() - $this->getPreco() * 0.065;
		return parent::calculaImposto() * 2;
    }
}
?>