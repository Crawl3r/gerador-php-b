<?php

	//protege de entrada sem ser ADM
	if($_SESSION != array()){
		if($_SESSION['nivel_usuario']=='adm'){	
		}else{
			echo "<script>window.location.href='" . HOME . "/403';</script>";
		}
	}else{
		echo "<script>window.location.href='" . HOME . "/403';</script>";
	}
	
	function senha() {
		
		$length = 8;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	
	}
	
?>
<div class="panel panel-default">
    <div style="font-size: 14pt" class="panel-heading">Cadastro de usuário</div>
    <div class="panel-body">

        <form class="form-inline" role="form" action="php/cad_usuario.php" method="POST">
            <label>Nome: </label>
            <input required class="form-control" type="text" name="nome" />
            <br />
            <label>Login: </label>
            <input required class="form-control" type="text" name="login" />
            <br />
            <label>Setor: </label>
            <select required class="form-control" name="setor">
                <option></option>
                <option>Simples</option>
                <option>Operacional</option>
            </select>
            <br />
            <label>Senha: </label>
            <input required class="form-control" value="<?php echo senha(); ?>" type="text" name="senha" />
            <br /><br />
            <button class="btn btn-default" type="submit">Cadastrar</button>
        </form>
    </div>
</div>
	
