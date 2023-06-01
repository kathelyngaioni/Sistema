<?php

class Aeroporto
{
  private $Sigla;
  private $Nome;
  private $Cidade;
  private $Estado;
  private $Geoposicao = [];

   public function __construct($sigla, $nome, $cidade, $estado, $geo){
    $size = strlen($sigla);
    if($size != 3){
      throw new Exception("ERRO: sigla inválida");
      } else{
      $this->Sigla = $sigla;
      $this->Nome = $nome;
      $this->Cidade = $cidade;
      $this->Estado = $estado;
      $this->Geoposicao = $geo;
      }
    }
  public function getSigla(){
      return $this->Sigla;
    }
    
    public function getNome(){
      return $this->Nome;
    }
    
    public function getCidade(){
      return $this->Cidade;
    }
    
    public function getEstado(){
      return $this->Estado;
    }

    public function gerarDescricao(){
  $descricao = "<p>Aeroporto <strong>" . $this->getNome() . "</strong> (" . $this->getSigla() . "), localizado em <strong>" . $this->getCidade() . "</strong>, " . $this->getEstado() . ".</p>";
  echo $descricao;
    }
    
    public function getLatitude(){
      return $this->Geoposicao[0];
    }
    
    public function getLongitude(){
      return $this->Geoposicao[1];
    }  
  }
}