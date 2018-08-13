<?php
//protege login em cima de login
if (isset($_SESSION)) {
    echo ($_SESSION !== [] ? "<script>window.location.href='" . HOME . "';</script>" : "");
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            
        </div>
        <div class=col-md-6">
            <div class="panel panel-default panel-small center">
                <div style="font-size: 14pt" class="panel-heading panel-heading-center">
                    <!--<img class="panel-heading-img" src="<?= INCLUDE_PATH; ?>/img/morada_logo.png" />-->
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="php/login_mec.php" method="POST">
                        <label>Login:</label>
                        <input autofocus class="form-control" required type="text" name="login" />
                        <label>Senha:</label>
                        <input class="form-control" required type="password" name="senha" />
                        <button class="btn btn-azul btn-block" type="submit">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">

        </div>
    </div>
    
</div>
