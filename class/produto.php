<?php 
abstract class Produto {
	private $id;
    private $nome;
    private $preco;
    private $descricao;
    private $categoria;
    private $usado;
	private $tipoProduto;
	
	function __construct($nome, $preco) 
    {
        $this->setNome($nome);
        $this->setPreco($preco);
        $this->setCategoria( new Categoria() );
    }
	
	abstract function atualizaBaseadoEm($params);
    //{
        /*if (method_exists($this, "setIsbn")) {
            $this->setIsbn($params["isbn"]);
        }
        if (method_exists($this, "setWaterMark")) {
            $this->setWaterMark($params["waterMark"]);
        }
        if (method_exists($this, "setTaxaImpressao")) {
            $this->setTaxaImpressao($params["taxaImpressao"]);
        }*/
        //$this->setDescricao($params["descricao"]);
   // }
	
	/*function __destruct() 
    {
        echo "Destruindo o produto ".$this->getNome();
    }*/
	
	function setTipoProduto($tipoProduto)
    {   
        $this->tipoProduto = $tipoProduto;
    }
    function getTipoProduto()
    {
        return $this->tipoProduto;
    }
	
	function temIsbn() {
        return $this instanceof Livro;
    }
	
	function calculaImposto()
    {
        return $this->preco - $this->preco * 0.195;
    }
	
	function __toString() 
    {
        return "Nome: ".$this->getNome().", Preço: ".$this.getPreco();
    }
	
	function subtraiDesconto($valor=0.05) {
        if ($valor > 0 && $valor < 1) {
            $this->preco -= $this->preco * $valor;
            return $this->preco;
        }
    }
	public function getId() 
    {
        return $this->id;
    }

    public function setId($id) 
    {
        $this->id = $id;
    }

    public function getNome() 
    {
        return $this->nome;
    }

    public function setNome($nome) 
    {
        $this->nome = $nome;
    }

    public function getPreco() 
    {
        return $this->preco;
    }

    public function setPreco($preco) 
    {
        $this->preco = $preco;
    }

    public function getDescricao() 
    {
        return $this->descricao;
    }

    public function setDescricao($descricao) 
    {
        $this->descricao = $descricao;
    }

    public function getUsado() 
    {
        return $this->usado;
    }

    public function setUsado($usado) 
    {
        $this->usado = $usado;
    }

    public function getCategoria() 
    {
        return $this->categoria;
    }

    public function setCategoria($categoria) 
    {
        $this->categoria = $categoria;
    }
}
?>