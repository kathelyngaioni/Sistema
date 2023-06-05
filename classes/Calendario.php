<?php

class Calendario
{
 private $anos = [];
 private $voos = [];
 public function __construct(){}   
 public function adicionarVoo($voo) :void
 {
    array_push($this->voos, $voo);
    $this->adicionarViagemSemanal($voo);
  }
   /*” recebe um objeto "Voo" como parâmetro, e utiliza a propriedade "frequencia" desse objeto
  para determinar em quais dias da semana o voo deve ser adicionado ao calendário.
  Em seguida, utiliza um loop para percorrer todos os dias do mês atual e adicionar as 
  viagens correspondentes aos dias da semana definidos na frequência do voo. “*/
  public function adicionarViagemSemanal($voo) {
    $frequencia = $voo->getFrequencia();
    $diasDaSemana = [
        'Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira',
        'Quinta-feira', 'Sexta-feira', 'Sábado'
    ];

    $hoje = new DateTime();
    $anoAtual = $hoje->format('Y');
    $mesAtual = $hoje->format('m');
    $primeiroDiaMesAtual = new DateTime("$anoAtual-$mesAtual-01");
    $ultimoDiaMesAtual = new DateTime($primeiroDiaMesAtual->format('Y-m-t'));

    $intervalo = new DateInterval('P1D');
    $data = new DateTime("$anoAtual-$mesAtual-01");
    while ($data <= $ultimoDiaMesAtual) {
      $diaDaSemanaData = $diasDaSemana[$data->format('w')]; 
      if (in_array($diaDaSemanaData, $frequencia)) { 
        $ano = $data->format('Y');
        $mes = $data->format('m');
        $dia = $data->format('d');
        if (!isset($this->anos[$ano])) {
          $this->anos[$ano] = [];
        }
        if (!isset($this->anos[$ano][$mes])) {
          $this->anos[$ano][$mes] = [];
        }
          
        $viagem = new Viagem($voo, $ano, $mes, $dia);
        $this->anos[$ano][$mes][$dia][] = $viagem;
        }
        $data->add($intervalo);
    }
  }

  /*” permite obter uma lista de voos para um determinado dia “*/
  public function getViagemPorDia($ano, $mes, $dia) {
    if (isset($this->anos[$ano][$mes][$dia])) {
      return $this->anos[$ano][$mes][$dia];
    }
    return [];
  }
  public function getVoos()
  {
    foreach($this->voos as $voo)
    {
      $voo->detalhes();
    }
  }
}
?>
