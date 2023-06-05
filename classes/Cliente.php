<?php

require_once('Pessoa.php');

class Cliente extends Pessoa {

    public function __construct($email, $login, $senha, $nome, $sobrenome, $documento, $tipo_documento){
        try{
          parent::__construct($email, $login, $senha, $nome, $sobrenome, $documento, $tipo_documento);
        } catch(Exception $e){
          throw $e;
        }
    }
    public function comprarPacote($pass, $origem, $destino, $dia, $mes, $ano, $bag){
        try{
          $pacote = new Pacote($this, $pass, $origem, $destino, $dia, $mes, $ano, $bag);
          array_push($this->getPacotes(), $pacote);
          $pass->addPacote($pacote);
        } catch(Exception $e){
          echo 'Exceção capturada: ',  $e->getMessage(), "\n";
        }
    }
}
