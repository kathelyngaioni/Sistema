<?php 

class Pacote {
  private $cliente; 
  private $passageiro; 
  private $conj_passagens = array();
  private $origem;
  private $destino;
  private $precoTotal;
  private $dia;
  private $mes;
  private $ano;
  private $DataChegada;
  private $bagagem;
  private $cartoesDeEmbarque = array();

  public function __construct ($cliente, $passageiro, $origem, $destino, $dia, $mes, $ano, $bag) {
    if($this->setPassagens($origem, $destino, $dia, $mes, $ano) == true) {
      $this->cliente = $cliente;
      $this->passageiro = $passageiro;
      $this->origem = $origem;
      $this->destino = $destino;
      $this->dia = $dia;
      $this->mes = $mes;
      $this->ano = $ano;
      $this->somaTarifas();
      try{
      $this->setBagagem($bag); 
      } catch(Exception $e){
        throw $e;
      }
      $cliente->save();
      $passageiro->save();
    } else{
      throw new Exception("Não é possível uma viagem entre essas duas localidades");
    }
  }

  public function setPassagens($origem, $dest, $dia, $mes, $ano) {
    $sistema = Sistema::getInstance();
    $viagens_do_dia = $sistema->getCalendario()->getViagemPorDia($ano, $mes, $dia);

    // Testa se a viagem direta existe
    foreach ($viagens_do_dia as $viagem) {
      if ($viagem->GetAeroPartida()->GetNome() == $origem->GetNome() && $viagem->GetAeroChegada()->GetNome() == $dest->GetNome() && $viagem->getNumPassagensDisponiveis() > 0) {
        $passagem = new Passagem($viagem->getTarifa(), $origem, $dest, $viagem->GetCompanhia(),$viagem);
        array_push($this->conj_passagens, $passagem);
        $viagem->vendePassagem($passagem);
        return true;
      }
    }

    // Tenta criar uma passagem com uma conexão
    foreach ($viagens_do_dia as $viagem1) {
      if ($viagem1->GetAeroPartida()->GetNome() == $or->GetNome() && $viagem1->getNumPassagensDisponiveis() > 0) {
        foreach ($viagens_do_dia as $viagem2) {
          if ($viagem2->GetAeroDestino()->GetNome() == $dest->GetNome() && $viagem1->GetAeroDestino()->GetNome() == $viagem2->GetAeroPartida()->GetNome() && $viagem2->getNumPassagensDisponiveis() > 0) {
            $passagem1 = new Passagem($viagem1->getTarifa(), $or, $viagem1->getDestino(),$viagem1->GetCompanhia(),$viagem1);
            $passagem2 = new Passagem($viagem2->getTarifa(), $viagem1->getDestino(), $dest,$viagem2->GetCompanhia(),$viagem2);
            array_push($this->conj_passagens, $passagem1);
            array_push($this->conj_passagens, $passagem2);
            $viagem1->VendePassagem($passagem1);
            $viagem2->VendePassagem($passagem2);
            return true;
          }
        }
      }
    }

    // Se não encontrou nenhuma viagem
    return false;
  }

   public function alterarPacote_p($passageiro, $origem, $destino, $dia, $mes, $ano, $DataChegada, $bagagem){
  $this->passageiro = $passageiro;
  $this->origem = $origem;
  $this->destino = $destino;
  $this->dia = $dia;
  $this->mes = $mes;
  $this->ano = $ano;
  $this->DataChegada = $DataChegada;
}

  
  //gera a tarifa total = valor de cada uma das passagens + preço das bagagens 
  public function somaTarifas(){
    $auxiliar = 0;
    for ($i = 0; $i < sizeof($this->conj_passagens); $i++) {
      $auxiliar += $this->conj_passagens[$i]->getTarifa();
    }
    $this->precoTotal = $auxiliar;
  }

  // Compra a bagagem
  public function setBagagem($bag){
    if ($bag >= 0 && $bag < 4){
      $this->bagagem = $bag;
      $auxiliar = 0;
      for ($i = 0; $i < sizeof($this->conj_passagens); $i++) {
        $auxiliar += $this->conj_passagens[$i]->getCompanhia()->getPrecoBagagem();
      }
      $this->precoTotal += $bag*($auxiliar);
    }else{
      throw new Exception("Esse número de franquias de bagagem não é permitido, é possivel adiquirir de 0 a 3 franquias de bagagem");
    }
  }

  public function getBagagem() {
    return $this->bagagem;
  }

  public function gerarDescricao() {
  $descricao = "Pacote de viagem de ".$this->origem->GetCidade()." para ".$this->destino->GetCidade().", ";
  $descricao .= "saindo no dia ".$this->dia."/".$this->mes."/".$this->ano.", ";
  $descricao .= "com as seguintes passagens: \n";
  foreach ($this->conj_passagens as $passagem) {
    $descricao .= "- De ".$passagem->getOrigem()->GetNome()." para ".$passagem->getDestino()->GetNome()." (tarifa: R$".$passagem->getTarifa().")\n";
  }
  $descricao .= "Totalizando R$".$this->precoTotal.".\n";
  if ($this->bagagem) {
    $descricao .= "Inclui bagagem despachada.\n".$this->getBagagem()." Mala(s) de 23 Kg.\n";
  }
  else {
    $descricao .= "Não inclui bagagem despachada.\n\n";
  }
  echo $descricao;
}

  public function check_in(){
    $i = 1;
    while($i < sizeof($this->conj_passagens)){
      $this->conj_passagens[$i]->setCheck_in();
      $i++;
    }
  }
}