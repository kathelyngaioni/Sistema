<?php

require_once('classes/Aeronave.php');
require_once('classes/Aeroporto.php');
require_once('classes/Calendario.php');
require_once('classes/Companhia.php');
require_once('classes/Voo.php');

$Latam = new Companhia('Latam','001','Latam Airlines do Brasil S.A','11.222.333/4444-55','LA',100);
$Latam->gerarDescricao();
$Azul = new Companhia('Azul','002','Azul Linhas Aéreas Brasileiras S.A.','22.111.333/4444-55','AD',100);
$Azul->gerarDescricao();

//incluir pertencimento a Aeronave
//o modelo é uma string
//$sistema->getCompanhias()[0]->adicionaAeronave("Embraer", 175, 180, 600, "PX-RUZ", 6);
//$sistema->getCompanhias()[0]->adicionaAeronave("Embraer", 175, 180, 600, "PP-RUZ", 6);

//$sistema->getCompanhias()[1]->adicionaAeronave("Embraer", 175, 180, 600, "PP-ABC", 6);

//$sistema->cadastrarAeroporto("CNF", "Confins", "Belo Horizonte", "Minas Gerais", array(-19.6243, -43.9719));
//$sistema->cadastrarAeroporto("GRU", "Guarulhos", "São Paulo", "São Paulo", array(-23.4356, -46.4731));
//$sistema->cadastrarAeroporto("CGH", "Congonhas", "São Paulo", "São Paulo", array(-23.6261, -46.6553));
//$sistema->cadastrarAeroporto("GIG", "Galeão", "Rio de Janeiro", "Rio de Janeiro", array(-22.8099, -43.2502));
//$sistema->cadastrarAeroporto("CWB", "Afonso Pena", "Curitiba", "Paraná", array(-25.5327, -49.1738));

//$sistema->cadastraVoo("AC1329", $sistema->getCompanhias()[1], array("Segunda-feira"), $sistema->getAeroportos()[0], $sistema->getAeroportos()[1], new DateTime('07:00:00'), new DateTime('08:30:00'), $sistema->getCompanhias()[1]->getAeronaves()[0], 0, 1000);

//$sistema->cadastraVoo("AD1329", $sistema->getCompanhias()[1], array("Segunda-feira"), $sistema->getAeroportos()[0], $sistema->getAeroportos()[1], new DateTime('07:00:00'), new DateTime('08:30:00'), $sistema->getCompanhias()[1]->getAeronaves()[0], 0, 1000);

//$sistema->cadastraVoo("AD1011", $sistema->getCompanhias()[0], array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"), $sistema->getAeroportos()[0], $sistema->getAeroportos()[1], new DateTime('09:00:00'), new DateTime('10:30:00'), $sistema->getCompanhias()[0]->getAeronaves()[0], 0, 1000);
//$sistema->cadastraVoo("AD1012", $sistema->getCompanhias()[0], array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"), $sistema->getAeroportos()[0], $sistema->getAeroportos()[1], new DateTime('13:00:00'), new DateTime('14:30:00'), $sistema->getCompanhias()[0]->getAeronaves()[0], 0, 1000);

//$sistema->cadastraVoo("AD1021", $sistema->getCompanhias()[1], array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"), $sistema->getAeroportos()[0], $sistema->getAeroportos()[2], new DateTime('09:00:00'), new DateTime('10:30:00'), $sistema->getCompanhias()[1]->getAeronaves()[0], 0, 1000);
//$sistema->cadastraVoo("AD1022", $sistema->getCompanhias()[1], array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"), $sistema->getAeroportos()[0], $sistema->getAeroportos()[2], new DateTime('13:00:00'), new DateTime('14:30:00'), $sistema->getCompanhias()[1]->getAeronaves()[0], 0, 1000);

//$sistema->cadastraVoo("AD1031", $sistema->getCompanhias()[0], array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"), $sistema->getAeroportos()[1], $sistema->getAeroportos()[3], new DateTime('09:00:00'), new DateTime('10:30:00'), $sistema->getCompanhias()[0]->getAeronaves()[0], 0, 1000);
//$sistema->cadastraVoo("AD1032", $sistema->getCompanhias()[0], array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"), $sistema->getAeroportos()[1], $sistema->getAeroportos()[3], new DateTime('13:00:00'), new DateTime('14:30:00'), $sistema->getCompanhias()[0]->getAeronaves()[0], 0, 1000);

//$sistema->cadastraVoo("AD1041", $sistema->getCompanhias()[1], array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"), $sistema->getAeroportos()[2], $sistema->getAeroportos()[4], new DateTime('09:00:00'), new DateTime('10:30:00'), $sistema->getCompanhias()[1]->getAeronaves()[0], 0, 1000);
//$sistema->cadastraVoo("AD1042", $sistema->getCompanhias()[1], array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"), $sistema->getAeroportos()[2], $sistema->getAeroportos()[4], new DateTime('13:00:00'), new DateTime('14:30:00'), $sistema->getCompanhias()[1]->getAeronaves()[0], 0, 1000);