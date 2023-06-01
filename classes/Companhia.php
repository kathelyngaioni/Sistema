<?php

class Companhia
{
  private $nome;
  private $codigo;
  private $razaoSocial;
  private $cnpj;
  private $sigla;
  protected $precoBagagem;
  public $aeronaves = array(); 

  public function __construct($n, $cod, $razao, $cnp, $sig, $p_bag)
  {
    $this->nome = $n;
    $this->codigo = $cod;
    $this->razaoSocial = $razao;
    $this->cnpj = $cnp;
    $this->sigla = $sig;
    $this->precoBagagem = $p_bag;
  }
  public function getNome(){
    return $this->nome;
  }
   public function getCodigo(){
    return $this->codigo;
   }
  public function getRazaoSocial(){
    return $this->razaoSocial;
  }
   public function getCNPJ(){
    return $this->cnpj;
  }
  public function getSigla(){
    return $this->sigla;
  }
  public function getPrecoBagagem(){
    return $this->precoBagagem;
  }
  public function getAeronaves(){
    return $this->aeronaves;
  }
   public function setPrecoBagagem($p_bag){
    $this->precoBagagem = $p_bag;
   }
  public function adicionaAeronave($pertencimento,$fabricante, $modelo, $capacidadePassageiros, $capacidadeCarga, $registro, $num_assentos_por_fileira){ 
    try{
      array_push($this->aeronaves, new Aeronave($pertencimento,$fabricante, $modelo, $capacidadePassageiros, $capacidadeCarga, $registro, $num_assentos_por_fileira));
    } catch(Exception $e){
      echo 'Exceção capturada: ',  $e->getMessage(), "\n";
    }
  }
    public function gerarDescricao(){
    $descricao = "<h2>" . $this->nome . " (" . $this->sigla . ")</h2>";
    $descricao .= "<p><strong>Código:</strong> " . $this->codigo . "</p>";
    $descricao .= "<p><strong>Razão social:</strong> " . $this->razaoSocial . "</p>";
    $descricao .= "<p><strong>CNPJ:</strong> " . $this->cnpj . "</p>";
    $descricao .= "<p><strong>Preço por bagagem:</strong> R$ " . $this->precoBagagem . "</p>";
    $descricao .= "<p><strong>Aeronaves:</strong>";
    echo $descricao;  
    foreach($this->aeronaves as $aeronave){
      $aeronave->gerarDescricao();
    }
  }
}