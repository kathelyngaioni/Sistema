<?php

class Viagem extends Voo{
  protected bool $executado = false;
  protected $horap_ex;
  protected $horac_ex;
  protected $aeronave_ex;
  protected $assentos = array();
  protected int $passagens_disponiveis; 
  protected $passagens_vendidas = array(); //guarda ponteiros para as passagens
  protected $data;

  /* inicializa a classe com base em um objeto Voo existente e define o número de passagens disponíveis com base no
  número de assentos na aeronave e armazena o mapa, e define a aeronave executada como a aeronave planejada (por padrao), 
  pq ela so seria trocada em caso de imprevistos então achei isso mais logico, mas existe uma função set pra ela*/ 
  public function __construct ($voo_base, $ano, $mes, $dia){
    parent::__construct($voo_base->getCodigo(), $voo_base->getCompanhia(), $voo_base->getFrequencia(), $voo_base->getAeroPartida(), $voo_base->getAeroChegada(), $voo_base->getHoraPartida(), $voo_base->getHoraChegada(), $voo_base->getAviaoP(), $voo_base->getTarifa());
    $this->passagens_disponiveis = $this->num_assentos;
    $this->assentos = $this->aviao_plane->assentos;
    $this->aeronave_ex = $this->aviao_plane;
    $this->data = new DateTime($ano . '-' . $mes . '-' . $dia);
  }

  /**/
  public function executar($horap, $horac){
    $this->setHora_Partida($horap);
    $this->setHora_Chegada($horac);
    $this->distribuiPontos();
  }

  /**/
  public function vendePassagem($passagem){
    array_push($this->passagens_vendidas, $passagem);
    $this->passagens_disponiveis--;
  }

  /**/
  public function ocupaAssento($fileira, $posicao) {
    if ($this->assentos[$fileira][$posicao]) {
      throw new Exception("Assento já ocupado.");
      return 0;
    }else{
      $this->assentos[$fileira][$posicao] = true;
      return 1;
    }
  }

  /*Retorna se um assento esta vago (return 1) ou ocupado (return 0)*/
  public function assentoVago($fileira, $posicao){
    if ($this->assentos[$fileira][$posicao]) {
      return 0;
    }else{
      return 1;
    }
  }

  /*Retorna se um assento esta disponivel (return 1) ou ocupado (return 0) */
  public function assentoDisponivel($fileira, $posicao) {
    //aqui deve ter esse "!" ?
    return !$this->assentos[$fileira][$posicao];
  }

  
  
  public function getExecutado(){
    return $this->executado;
  }
  
  public function getData(){
    return $this->data;
  }
    
  public function getHora_Partida(){
    return $this->horap_ex;
  }
  
  public function getHora_Chegada(){
    return $this->horac_ex;
  }
  
  public function getAeronave(){
    return $this->aeronave_ex;
  }

  public function getNumAssentosPorFileiraDaAeronave(){
    $numAssentos = $this->aeronave_ex->getNumAssentosPorFileira();
    return $numAssentos;
  }

  public function setHora_Partida($horap){
    if ($this->horac_ex && $horap > $this->horac_ex) {
      throw new Exception("Hora de partida não pode ser posterior à hora de chegada.");
    }
    $this->horap_ex = $horap;
  }

  public function setHora_Chegada($horac){
    if ($this->horap_ex && $horac < $this->horap_ex) {
      throw new Exception("Hora de chegada não pode ser anterior à hora de partida.");
    }
    $this->horac_ex = $horac;
  }

  public function setAeronave($aero){
    $this->aeronave_ex = $aero;
  }

  public function getAeroPartida() {
    return parent::getAeroPartida();
  }

  public function getAeroChegada() {
    return parent::getAeroChegada();
  }

  public function getNumPassagensDisponiveis() {
    return $this->$passagens_disponiveis;
  }


  public function gerarDescrição(){
    $data = $this->getData();
    $dia_da_semana = $data->format('l');
    $dias_da_semana = ['Sunday' => 'Domingo', 'Monday' => 'Segunda-feira', 'Tuesday' => 'Terça-feira', 'Wednesday' => 'Quarta-feira', 'Thursday' => 'Quinta-feira', 'Friday' => 'Sexta-feira', 'Saturday' => 'Sábado'];
    $dia_da_semana = $dias_da_semana[$dia_da_semana];
    $descricao = $dia_da_semana.", ".$data->format('d/m/Y')."\n";
    $descricao .= "Voo: ".$this->getCodigo().", ".$this->getCompanhia()->getNome()."\n";
    $descricao .= "Partindo de ".$this->getAeroPartida()->getSigla()." ".$this->getAeroPartida()->getCidade().", às ".$this->getHoraPartida();
    $descricao .= ", para ".$this->getAeroChegada()->getSigla()." ".$this->getAeroChegada()->getCidade().", às ".$this->getHoraChegada()."\n";
    $descricao .= "R$ ".$this->getTarifa();
    return $descricao;
  }

  public function AdicionaEndereco($logradouro, $numero, $bairro, $cep, $estado) {
  $endereco = new Endereco($logradouro, $numero, $bairro, $cep, $estado);
    array_push($this->Endereco_array, $endereco);
  }

  public function  calcular_Distancia_Rota(){
    
  }

  public function calcular_Horario_Partida_Onibus(){
    
  }
}  

?>