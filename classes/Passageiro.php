<?php
  
class Passageiro extends Pessoa {
  protected bool $isVip;
  protected $CPF;
  protected $Nacionalidade;
  protected $Data_nascimento;
  public $Pacotes = array(); //salva ponteiros para os pacotes correspondentes a esse passageiro

  public function __construct($email, $login, $senha, $acesso, $nome, $sobrenome, $documento, $tipo_documento, $is_vip, $cpf, $nacionalidade, $data_nasc) {
    if($this->validarCPF($cpf) && $this->validarDataNasc($data_nasc)){
      try{
        parent::__construct($email, $login, $senha, $acesso, $nome, $sobrenome, $documento, $tipo_documento);
      } catch(Exception $e){
        throw $e;
      }
      $this->isVip = $is_vip;
      $this->CPF = $cpf;
      $this->Nacionalidade = $nacionalidade;
      $this->Data_nascimento = $data_nasc;
    } else if(!$this->validarCPF($cpf)){
      throw new Exception(" CPF inválido");
    } else {
      throw new Exception("Data de nascimento inválida");
    }    
  }
  public function getIsVip(){
    return $this->isVip;
  }

  public function validarCPF($cpf){
    // Remover caracteres especiais
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
    // Verificar se possui 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }
    
    // Verificar se todos os dígitos são iguais
    if (preg_match('/^(\d)\1+$/', $cpf)) {
        return false;
    }
    
    // Validar o primeiro dígito verificador
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += ($cpf[$i] * (10 - $i));
    }
    $resto = $soma % 11;
    if ($resto < 2) {
        $digito1 = 0;
    } else {
        $digito1 = 11 - $resto;
    }
    if ($cpf[9] != $digito1) {
        return false;
    }
    
    // Validar o segundo dígito verificador
    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += ($cpf[$i] * (11 - $i));
    }
    $resto = $soma % 11;
    if ($resto < 2) {
        $digito2 = 0;
    } else {
        $digito2 = 11 - $resto;
    }
    if ($cpf[10] != $digito2) {
        return false;
    }
    
    // CPF válido
    return true;
  }

  public function validarDataNasc($data){
    $dataObj = DateTime::createFromFormat('Y-m-d', $data);
    $dataAtual = new DateTime();
    
    if (!$dataObj || $dataObj->format('Y-m-d') != $data) {
        return false;
    }
    
    if ($dataObj > $dataAtual) {
        return false;
    }
    
    return true;
  }

  public function addPacote($ponteiro_pacote){
    array_push($this->Pacotes, $ponteiro_pacote);
  }
  
  public function historicoDeViagens(){
    foreach ($this->Pacotes as $pacote) {
        $pacote->gerarDescricao();
      }
  }

  public function gerarDescricaoPassageiro(){
    $descricao = "<h2>Passageiro:</h2>";
    $descricao .= "<p><strong>Nome:</strong> " . $this->getNome() . " " . $this->getSobrenome() . "</p>";
    $descricao .= "<p><strong>Tipo de documento:</strong> " . $this->getTipoDocumento() . "</p>";
    $descricao .= "<p><strong>Número do documento:</strong> " . $this->getNumDocumento() . "</p>";
    $descricao .= "<p><strong>E-mail:</strong> " . $this->getEmail() . "</p>";
    $descricao .= "<p><strong>Tipo:</strong> " . $this->getTipo() . "</p>";
    $descricao .= "<p><strong>CPF:</strong> " . $this->getCPF() . "</p>";
    $descricao .= "<p><strong>Nacionalidade:</strong> " . $this->getNacionalidade() . "</p>";
    $descricao .= "<p><strong>Data de nascimento:</strong> " . $this->getDataNasc() . "</p>";

    if (empty($this->Pacotes)) {
      $descricao .= "<p><strong>Nenhum pacote relacionado.</strong></p>";
      echo $descricao;
    } else {
      $descricao .= "<h3>Pacote(s) relacionado(s) ao passageiro:</h3>";
      echo $descricao;
      $this->historicoDeViagens();
    }
  }

  
  public function getTipo() {
    return $this->isVip;
  }

  public function getCPF() {
    return $this->CPF;
  }

  public function getNacionalidade() {
    return $this->Nacionalidade;
  }

  public function getDataNasc() {
    return $this->Data_nascimento;
  }

  public function getPacotes() {
    return $this->Pacotes;
  }

  public function alterarPacote(){
    $date = new DateTime();
    $date_p = new \DateInterval("PT4H");
    $result = date_sub(, $date_p);
    $string_result = $result->format('H:i:s');
    
  }
  
  public function cancelarPacote(){
    array_pop($this->Pacotes);
  }

}


?>