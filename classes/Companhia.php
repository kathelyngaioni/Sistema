<?php

class Companhia
{
  private string $nome;
  private string $codigo;
  private string $razaoSocial;
  private string $cnpj;
  private string $sigla;
  private float $precoBagagem;
  public $aeronaves = array(); 

  public function __construct(string $n, string $cod, string $razao, string $cnp, string $sig, float $p_bag)
  {
    $this->nome = $n;
    $this->codigo = $cod;
    $this->razaoSocial = $razao;
    $this->cnpj = $cnp;

    if(Companhia::confereSigla($sig)){
      $sigla = mb_strtoupper($sig);
      $this->sigla = $sigla;
    }     

    $this->precoBagagem = $p_bag;
  }
  private function confereSigla(string $sigla) : bool
  {
    if( (mb_strlen($sigla) == 2) && gettype($sigla) =='string')
      return true;
    else {
      //tratar a Sigla da Companhia Áerea
      echo "Sigla invalida" . PHP_EOL;
      return false;
    }
  }
  public function getNome() :string
  {
    return $this->nome;
  }
   public function getCodigo() :string
   {
    return $this->codigo;
   }
  public function getRazaoSocial() :string
  {
    return $this->razaoSocial;
  }
   public function getCNPJ() :string
   {
    return $this->cnpj;
  }
  public function getSigla() :string
  {
    return $this->sigla;
  }
  public function getPrecoBagagem() :float
  {
    return $this->precoBagagem;
  }
  public function getAeronaves() :array
  {
    return $this->aeronaves;
  }
   public function setPrecoBagagem(float $p_bag) :void
   {
    $this->precoBagagem = $p_bag;
   }
  public function adicionaAeronave(string $pertencimento,string $fabricante, string $modelo, int $capacidadePassageiros, float $capacidadeCarga, string $registro, int $num_assentos_por_fileira) :void
  { 
    try{
      array_push($this->aeronaves, new Aeronave($pertencimento,$fabricante, $modelo, $capacidadePassageiros, $capacidadeCarga, $registro, $num_assentos_por_fileira));
    } catch(Exception $e){
      echo 'Exceção capturada: ',  $e->getMessage(), "\n";
    }
  }
    public function gerarDescricao() :void
    {
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