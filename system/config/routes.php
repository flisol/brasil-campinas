<?php
//Required Routes
$routes['__defaultAction'] = 'docs';
$routes['__defaultController'] = 'Users';

$routes['users/[0-9]'] = "Users/get/$1";

//Route example (you can also see more at Router documentation)
//$routes['example'] = "exampleController";
//$routes['example/([[:alnum:]&:-@_]+)'] = "exampleController/$1";
//$routes['example/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "exampleController/$1/$2";
//$routes['example/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "exampleController/$1/$2/$3";
//$routes['example/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "exampleController/$1/$2/$4";
//$routes['example/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "exampleController/$1/$2/$4/$5";
//$routes['example/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)/([[:alnum:]&:-@_]+)'] = "exampleController/$1/$2/$4/$5/$6";
?>