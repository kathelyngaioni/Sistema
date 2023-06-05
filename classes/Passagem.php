<?php

class Passagem {
    private $viagem;
    private DateTime $horario_partida;
    private DateTime $horario_embarque;
    private float $tarifa;
    private $Passageiro;
    private Aeroporto $origem;
    private Aeroporto $destino;
    private Companhia $companhia;
    private $assento; //null
    private bool $NOSHOW;
    private bool $Embarcado;
    private bool $Adquirida;
    private bool $Check_in;
    private bool $Cancelada;
  
    
    public function __construct(float $t, Aeroporto $ori, Aeroporto $dest, Companhia $comp, $viagem){
      $this->tarifa = $t;
      $this->origem = $ori;
      $this->destino = $dest; 
      $this->companhia = $comp;
      $this->viagem = $viagem;
      $this->horario_partida = $viagem->getHoraPartida();
      $this->horario_embarque = calculaHoraEmbarque($this->horario_partida);
      $this->assento = null;
    }
    
    public function getPassageiro(){
      return $this->Passageiro;
    }
    public function getOrigem(){
      return $this->origem;
    }
  
    public function getDestino(){
      return $this->destino;
    }
  
    public function getTarifa(){
      return $this->tarifa;
    }
  
    public function getCompanhia(){
      return $this->companhia;
    }

    public function setEmbarcado($embarque){
      $this->Embarcado = $embarque;
    }
  
    public function setAdquirida($adquirir){
      $this->Adquirida = $adquirir;
    }

  
    public function setCancelada($cancela){
      $this->Cancelada = $cancela;
    }
  
    public function setAssento($str){
      $fileira = $str[0]*10 + $str[1]; 
      $posicao = $str[3];
      if(this->viagem->ocupaAssento($fileira, $posicao)){
        $this->assento = $str;
      }
    }
  
    /*Define para essa passagem o primeiro assento livre encontrado no array de assentos da Viagem*/
    public function setAssentoAutomatico(){
      $fileira = 1;
      $posicao = 1;
      while(assentoVago($fileira, $posicao) == 0){
        if($posicao = (this->viagem->getNumAssentosPorFileiraDaAeronave() - 1)){
          $fileira++;
          $posicao = 1;
        }else{
          $posicao++;
        }
      }
      this->viagem->ocupaAssento($fileira, $posicao);
      $posicao = $posicao + 64;
      $format = "%d%c";
      $str = sprintf($format, $fileira, $posicao);
      $this->assento = $str;
      
    }
  
  
    public function getNOSHOW(){
      return $this->NOSHOW; 
    }
  
    public function getEmbarcado(){
      return $this->Embarcado;
    }
  
    public function getAdquirida(){
      return $this->Adquirida;
    }
  
    public function getCheckIn(){
      return $this->Check_in;
    }
  
    public function getCancelado(){
      return $this->Cancelada;
    }
    
    public function getAssento(){
      return $this->assento;
    }
  
    public function getBagagem(){
      return $this->bagagem;
    }
  
    
    public function GerarDescricao(){
      echo "<p>----------------------------------------------------</p>";
      echo $this->tarifa;
      echo "<br/>";
      echo $this->origem;
      echo "<br/>";
      echo $this->destino;
      echo "<br/>";
      echo $this->assento;
      echo "<br/>";
      echo "<p>----------------------------------------------------</p>";
    } 
  
    //gera a string do cartao de embarque
    public function GerarStringCartaoEmbarque(){
      $str = "Nome: " . $this->Passageiro->getNome() . $this->Passageiro->getSobrenome() . "\n";
      $str = $str . "Origem: " . $this->origem->getSigla() . " - " . $this->origem->getNome() . "\n";
      $str = $str . "Destino: " . $this->destino->getSigla() . " - " . $this->destino->getNome() . "\n";
      $str = $str . "Horário de embarque: " . $this->horario_embarque . "\n";
      $str = $str . "Horário de partida: " . $this->horario_partida . "\n";
      $str = $str . "Assento: " . $this->assento . "\n";
  
      return $str;
    } 
}