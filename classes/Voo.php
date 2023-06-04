<?php

class Voo {
  protected string $codigo;
  protected string $companhia;
  protected $frequencia = array();
  protected $origem;
  protected $destino;  
  protected DateTime $horario_p;
  protected DateTime $horario_c;
  protected $aviao_plane;
  protected int $num_assentos;
  protected float $tarifa;

public function __construct(string $cod, string $comp, array $fre, $origem, $destino, DateTime $hp, DateTime $hc, $aviao, float $ta){
    // Verifica se as duas primeiras letras do código coincidem com a sigla da companhia, se sim cria o objeto voo
    $sigla = substr($cod, 0, 2);
    if ($sigla != $comp->getSigla()) {
      throw new Exception("Código inválido: As duas primeiras letras do código devem coincidir com a sigla da companhia responsável pelo voo");
    } else {
      $this->codigo = $cod;  
      $this->companhia = $comp;
      $this->frequencia = $fre;
      $this->origem = $origem;
      $this->destino = $destino;
      $this->horario_p = $hp;
      $this->horario_c = $hc;
      $this->aviao_plane = $aviao;
      $this->num_assentos = $aviao->getCapacidadePassageiros();
      $this->tarifa = $ta;
    }
}
  public function getCodigo() :string
  {
    return $this->codigo;
  }

  public function getCompanhia() :string
  {
    return $this->companhia;
  }

  public function getAeroPartida()
  {
    return $this->origem;
  }

  public function getAeroChegada()
  {
    return $this->destino;
  }

  public function getHoraPartida() :DateTime
  {
    return $this->horario_p;
  }

  public function getHoraChegada() :DateTime
  {
    return $this->horario_c;
  }

  public function getAviaoP(){
    return $this->aviao_plane;
  }
  
  public function getFrequencia() :array
  {
    return $this->frequencia;
  }

  public function getTarifa() :float
  {
    return $this->tarifa;
  }
  public function AlterFreq($d, $s, $t, $q, $q1, $s1, $s2){
    $this->frequencia[0] = $d;
    $this->frequencia[1] = $s;
    $this->frequencia[2] = $t;
    $this->frequencia[3] = $q;
    $this->frequencia[4] = $q1;
    $this->frequencia[5] = $s1;
    $this->frequencia[6] = $s2;
   }
  }
