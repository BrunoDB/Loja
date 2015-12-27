<?php 

class LivroFisico extends Livro {
    private $taxaImpressao;
    function getTaxaImpressao()
    {
        return $this -> taxaImpressao;
    } 
    function setTaxaImpressao($taxaImpressao)
    {
        $this -> taxaImpressao = $taxaImpressao;
    }
	function atualizaBaseadoEm($params)
    {
        $this->setIsbn($params["isbn"]);
        $this->taxaImpressao = $params["taxaImpressao"];
        $this->setDescricao($params["descricao"]);
    }
}

?>