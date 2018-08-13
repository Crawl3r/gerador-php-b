<?php

include "../_app/Config.inc.php";

//	$info = $_POST;
//	
//	$user = $crud->chk_login($info);
//
//	if($user!=array()){
//        
//		$_SESSION['id_usuario'] = $user[0]['id_usuario'];
//		$_SESSION['nome_usuario'] = $user[0]['nome_usuario'];
//        $_SESSION['nivel_usuario'] = $user[0]['nivel_usuario'];
//		
//		echo "<script>alert('Bem Vindo(a) ". $_SESSION['nome_usuario'] ."!');window.location.href='../';</script>";
//		
//	}else{
//		echo "<script>alert('Usuário ou Senha incorreto(s)!');window.location.href='../login';</script>";
//	}

$info = $_POST;

$user = $crud->chk_login($info);

if ($user !== array()) {

    if ($user[0]['ativo_usuario'] != 0) {

        //zera a senha
        $user[0]['senha_usuario'] = 'não interessa pra você palhaço!';
        $user[0][2] = 'não interessa pra você palhaço!';

        $_SESSION = array_unique($user[0]);

       echo "<script>window.location.href='../';</script>";
    } else {
        echo "<script>alert('Usuário Bloqueado!');window.location.href='../login';</script>";
    }
} else {
    echo "<script>alert('Usuário ou Senha incorretos!');window.location.href='../login';</script>";
}