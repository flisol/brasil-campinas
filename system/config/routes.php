<?php
//Required Routes
$routes['__defaultAction'] = 'index';
$routes['__defaultController'] = 'InscricoesAPI';

$routes['users/[[a-f0-9A-F]{5,32})'] = "InscricoesAPI/get/$1"; //este é um alias para buscar API/users/UUID que chama diretamente o parametro get

$routes['users'] = "InscricoesAPI";
$routes['users/([[:alnum:]&:-@_]+)'] = "InscricoesAPI/$1";
$routes['users/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "InscricoesAPI/$1/$2";
$routes['users/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "InscricoesAPI/$1/$2/$3";
$routes['users/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "InscricoesAPI/$1/$2/$3/$4";


$routes['palestras'] = "PalestrasAPI";
$routes['palestras/([[:alnum:]&:-@_]+)'] = "PalestrasAPI/$1";
$routes['palestras/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "PalestrasAPI/$1/$2";
$routes['palestras/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "PalestrasAPI/$1/$2/$3";
$routes['palestras/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "PalestrasAPI/$1/$2/$3/$4";


$routes['inscricoes'] = "InscricoesAPI";
$routes['inscricoes/([[:alnum:]&:-@_]+)'] = "InscricoesAPI/$1";
$routes['inscricoes/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "InscricoesAPI/$1/$2";
$routes['inscricoes/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "InscricoesAPI/$1/$2/$3";
$routes['inscricoes/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "InscricoesAPI/$1/$2/$3/$4";

//Route example (you can also see more at Router documentation)
//$routes['example'] = "exampleController";
//$routes['example/([[:alnum:]&:-@_]+)'] = "exampleController/$1";
//$routes['example/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "exampleController/$1/$2";
//$routes['example/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "exampleController/$1/$2/$3";
//$routes['example/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "exampleController/$1/$2/$4";
//$routes['example/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "exampleController/$1/$2/$4/$5";
//$routes['example/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "exampleController/$1/$2/$4/$5/$6";
?>