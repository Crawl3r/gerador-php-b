<?php

session_start();

$dir = explode('\\',getcwd());
if(end($dir)=='php'){
    include "./querys.php";
}else{
    include "php/querys.php";
}

$crud = new crud();

//preenchimentos automáticos
$usuario_l = $crud->pdo_src('usuario','WHERE ativo_usuario = 1');

//Rotas
define('HOME','http://localhost/aleatorio');
define('THEME','sshtml');

define('INCLUDE_PATH', HOME . '/themes/' . THEME);
define('REQUIRE_PATH','themes/' . THEME);

//IMAGENS PADRÃO
define('LOGO_NAV',  INCLUDE_PATH."/img/logo_nav.png");
define('LOGO_NORM', INCLUDE_PATH."/img/logo_norm.png");

//CATEGORIAS
$categorias = array(
    'Pagamentos',
    'Falta Indevida',
    'Benefícios',
    'Folha de Ponto e C. CH',
    'Dobras e Extra',
    'Férias',
    'Outros'
);

define('CAT_CH',$categorias);

$CAT_CH = array(
    'Pagamentos',
    'Falta Indevida',
    'Benefícios',
    'Folha de Ponto e C. CH',
    'Dobras e Extra',
    'Férias',
    'Outros'
);

////Empresas Crachá
$empresas_cr = array(
    'Rio Service' => '1',
    'Forte Service' => '2',
    'FRS' => '3',
    'Rio Fire' => '4',
    'Vila Rio' => '5',
    'Vila Sul' => '6',
    'Forte Sul' => '7'
);

define('EMP_CR',$empresas_cr);

//-----------------------------------------------------------------------
$getUrl = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
$setUrl = (empty($getUrl) ? 'index' : $getUrl);
$Url = explode('/', $setUrl);