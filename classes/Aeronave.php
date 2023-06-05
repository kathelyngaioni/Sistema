<?php

class Aeronave {

  private string $pertencimento; //toda aeronave pertence a uma companhia aerea
  private string $fabricante;
  private string $modelo;
  private int $capacidadePassageiros;
  private float $capacidadeCarga;
  private string $registro;
  public $assentos = array();
  private int $num_assentos_por_fileira;

 public function __construct(string $pertencimento,string $fabricante, string $modelo, int $capacidadePassageiros, float $capacidadeCarga, string $registro, int $num_assentos_f){
    if($this->validaRegistro($registro) == 1){
      $this->pertencimento = $pertencimento;
      $this->fabricante = $fabricante;
      $this->modelo = $modelo;
      $this->capacidadePassageiros = $capacidadePassageiros;
      $this->capacidadeCarga = $capacidadeCarga;
      $this->registro = $registro;
      $this->num_assentos_por_fileira = $num_assentos_f;
      $this->montaArrayAssentos();
    }else{
      throw new Exception("Registro inválido");
    }
  }
  public function getPertencimento() :string
  {
    return $this->pertencimento;
  }
  public function getFabricante() :string
  {
    return $this->fabricante;
  }
  
  public function getModelo() :string
  {
    return $this->modelo;
  }

  public function getNumAssentosPorFileira() :int
  {
    return $this->num_assentos_por_fileira;
  }
  
  public function getCapacidadePassageiros() :int
  {
    return $this->capacidadePassageiros;
  }
  
  public function getCapacidadeCarga() :float
  {
    return $this->capacidadeCarga;
  }
  
  public function getRegistro() :string
  {
    return $this->registro;
  }
  
  private function validaRegistro($registro) :bool
  {
    //Valida o registro da aeronave
    $prefixo = substr($registro, 0, 2);
    $sufixo = substr($registro, 3, 3);
    $prefixosValidos = array('PT', 'PR', 'PP', 'PS');
    
    if(in_array($prefixo, $prefixosValidos) && preg_match('/^[a-zA-Z]{3}$/', $sufixo)){
      return true;
    } else {
      return false;
    }
  }

  private function montaArrayAssentos() :void
  {
    $a = $this->capacidadePassageiros; //num assentos total
    $b = $this->num_assentos_por_fileira;
    $c = $a/$b; //num fileiras
    for($i = 1; $i <= $c; $i++) { // 10 fileiras (temos que ver o numero de fileiras do aviao)
      for($j = 'A'; $j <= chr(65 + $b - 1); $j++) { // Assentos de A a F em cada fileira
        $this->assentos[$i][$j] = false; // Assento livre
      }
    }
  }

  public function getArrayAssentos()
  {
    return implode(" ", $this->assentos);
  }

 public function gerarDescricao() :void
 {
    $descricao = "<br>Aeronave ".$this->fabricante." ".$this->modelo." com registro ".$this->registro."<br>";
    $descricao .= "Capacidade de ".$this->capacidadePassageiros." passageiros e ".$this->capacidadeCarga." kg de carga.<br>";
    $descricao .= "Pertencimento ".$this->pertencimento."<br>";
    $descricao .= "Assentos: ".$this->capacidadePassageiros." (".$this->num_assentos_por_fileira." por fileira).<br>";
    echo $descricao;
  }
}