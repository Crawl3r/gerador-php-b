<?php

	//protege de entrada sem login
	if($_SESSION != array()){
		if(@$_SESSION['nivel_usuario']!='adm'){
			echo "<script>window.location.href='" . HOME . "/403';</script>";
		}
	}else{
		echo "<script>window.location.href='" . HOME . "/403';</script>";
	}
	
	$usuario = $crud->pdo_src('usuario','WHERE id_usuario = ' . $_POST['id']);
	
?>
		
<div class="panel panel-default">
    <div style="font-size: 14pt" class="panel-heading">Edição de Usuário</div>
    <div class="panel-body">

        <form class="form-inline" role="form" action="php/edita_usuario.php" method="post">
            <input type="hidden" name="id" value="<?php echo $usuario[0]['id_usuario'] ?>" />
            <h3>Info. usuario</h3>
            <label>Nome: </label>
            <input class="form-control" value="<?php echo $usuario[0]['nome_usuario'] ?>" type="text" name="nome" />
            <br />
            <label>Login: </label>
            <input class="form-control" value="<?php echo $usuario[0]['login_usuario'] ?>" type="text" name="login" />
            <br />
            <label>Setor: </label>
            <select required class="form-control" name="setor">
                <option></option>
                <option <?= $usuario[0]['setor_usuario']=='Simples' ? 'selected' : '' ?> >Simples</option>
                <option <?= $usuario[0]['setor_usuario']=='Operacional' ? 'selected' : '' ?> >Operacional</option>
            </select>
            <br />
            <input class="btn btn-default" type="submit" value="Salvar Alterações" />			
        </form>

        <br />

        <div style="max-width: 650px" class="panel panel-default panel-warning">
            <div style="font-size: 14pt" class="panel-heading">Trocar senha</div>
            <div class="panel-body">
                <form class="form-inline" role="form" action="php/edita_senha.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $usuario[0]['id_usuario'] ?>" />
                    <label>Senha antiga: </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="form-control" type="password" name="antiga" />
                    <br />
                    <label>Nova senha: </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="form-control" type="password" name="nova" />
                    <br />
                    <label>Confima senha: </label>
                    &nbsp;&nbsp;
                    <input class="form-control" type="password" name="confirma" />
                    <br />
                    <button class="btn btn-default">Trocar Senha</button>
                </form>
            </div>
        </div>

    </div>
</div>
