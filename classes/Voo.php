<?php

class Voo{
  protected $codigo;
  protected $companhia;
  protected $frequencia = array();
  protected $origem;
  protected $destino;  
  protected $horario_p;
  protected $horario_c;
  protected $aviao_plane;
  protected $num_assentos;
  protected $tarifa;
  protected $aviao_plane;

public function __construct($cod, $comp, $fre, $origem, $destino, $hp, $hc, $aviao, $ta){
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
  public function getCodigo(){
    return $this->codigo;
  }

  public function getCompanhia(){
    return $this->companhia;
  }

  public function getAeroPartida(){
    return $this->origem;
  }

  public function getAeroChegada(){
    return $this->destino;
  }

  public function getHoraPartida(){
    return $this->horario_p;
  }

  public function getHoraChegada(){
    return $this->horario_c;
  }

  public function getAviaoP(){
    return $this->aviao_plane;
  }
  
  public function getFrequencia(){
    return $this->frequencia;
  }

  public function getTarifa(){
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
