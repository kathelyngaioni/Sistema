<?php

require_once('classes/Aeronave.php');
require_once('classes/Aeroporto.php');
require_once('classes/Calendario.php');
require_once('classes/Companhia.php');
require_once('classes/Voo.php');
require_once('classes/Viagem.php');
require_once('classes/Cliente.php');

$Latam = new Companhia('Latam','001','Latam Airlines do Brasil S.A','11.222.333/4444-55','LA',100);
$Azul = new Companhia('Azul','002','Azul Linhas Aéreas Brasileiras S.A.','22.111.333/4444-55','AD',100);

$aeronave1 = new Aeronave('Latam','Embraer','175',180,600,'PP-RUZ',6);
$aeronave2 = new Aeronave('Azul','Embraer','175',180,600,'PP-ABC',6);

$aeroportoConfins = new Aeroporto('CNF','Confins','Belo Horizonte','Minas Gerais',array(-19.6243, -43.9719));
$aeroportoGuarulhos = new Aeroporto('GRU','Guarulhos','São Paulo','São Paulo',array(-23.4356, -46.4731));

$voo = new Voo('AD1329',$Azul,array("Segunda-feira"),$aeroportoConfins,$aeroportoGuarulhos, new DateTime('07/04/2023 07:00:00'), new DateTime('07/04/2023 08:30:00'),$aeronave1,1000);
//$voo->detalhes();
$calendario = new Calendario();
$calendario->adicionarVoo($voo);
//$calendario->getVoos();

$Kathelyn = new Cliente('gaioni.kathelyn@outlook.com','kathelyngaioni','123456','Kathelyn','Gaioni','20.908.335','carteira_identidade');
