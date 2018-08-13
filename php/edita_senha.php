<?php
	
	include "../_app/Config.inc.php";
	
	$info = $_POST;
	
	$usuario = $crud->pdo_src('usuario','WHERE id_usuario = ' . $info['id']);
	
	if($info['antiga']==$usuario[0]['senha_usuario']){
        
		if($info['nova']==$info['confirma']){
            
			$crud->edita_senha($info['id'],$info['nova']);
            
			echo ("<SCRIPT LANGUAGE='JavaScript'>
			    window.alert('Senha alterada com sucesso!');
			    window.location.href='../';
			    </SCRIPT>");
            
		}else{
            
			echo ("<SCRIPT LANGUAGE='JavaScript'>
			    window.alert('Senhas não conferem!');
			    window.location.href='../';
			    </SCRIPT>");
            
		}
	}else{
        
		echo ("<SCRIPT LANGUAGE='JavaScript'>
			    window.alert('Senha atual incorreta!');
			    window.location.href='../';
			    </SCRIPT>");
        
	}
	
?>