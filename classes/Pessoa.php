<?php

class Pessoa
{
    protected string $nome;
    protected string $sobrenome;
    protected $email;
    protected $num_documento;
    protected $tipo_documento;
    protected $senha;

    public function __construct($email, $login, $senha, string $nome, string $sobrenome, $documento, $tipo_documento) {
        if($this->validaEmail($email) && $this->validaDocumento($documento, $tipo_documento)){
          $this->nome = $nome;
          $this->sobrenome = $sobrenome;
          $this->num_documento = $documento;
          $this->tipo_documento = $tipo_documento;
        } else {
          if($this->validaEmail($email)){
            throw new Exception("Documento inválido");
          }else{
            throw new Exception("Email inválido");
          }
        } 
    }
    public function getNome() {
        return $this->nome;
      }
    
      public function getSobrenome() {
        return $this->sobrenome;
      }
    
      public function getEmail() {
        return $this->email;
      }
    
      public function getSenha(){
        return $this->senha;
      }
    
      public function getNumDocumento() {
        return $this->num_documento;
      }
    
      public function getTipoDocumento() {
        return $this->tipo_documento;
      }
    
      private function validaEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
      }
      
      private function validaDocumento($num_documento, $tipo_documento) {
        /*
        if ($tipo_documento === 'carteira_identidade') {
          return preg_match('/^\d{9}$/', $num_documento);
        } elseif ($tipo_documento === 'passaporte') {
          return preg_match('/^[A-Z]{2}\d{7}$/', $num_documento);
        }
        return false;
      }
      */
      return true;
    }
}