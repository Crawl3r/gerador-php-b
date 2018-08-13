<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <ul class="nav navbar-nav" id="logo_menu">
                <li>
                    <a href="<?= HOME; ?>/" class="pull-left navbar-brand"> <img class="nav_logo" style="width: 55px !important" src="<?= LOGO_NAV; ?>" /> </a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left" id="bs-example-navbar-collapse-1">

                <?php if (@$_SESSION != array()) { ?>
                
                    <?php if ($_SESSION['nivel_usuario'] != "adm") { ?>
						
                        <li><a href="edita_usuario_user?id=<?php echo $_SESSION['id_usuario'] ?>">Usuário</a></li>

                    <?php } else { ?>

                        <li>
                            <a href="<?= HOME; ?>/lista_ger">Gerência</a>
                        </li>
                        <li>
                            <a href="edita_adm?id=<?php echo $_SESSION['id_usuario'] ?>">Administrador</a>
                        </li>

                    <?php } ?>

                <?php } ?>
                        
                

            </ul>
            <ul class="nav navbar-nav navbar-right" id="bs-example-navbar-collapse-1">

                <?php if (@$_SESSION != array()) { ?>

                    <li>
                        <a href="php/logoff.php"> <img src="<?= INCLUDE_PATH; ?>/img/glyph-log-out.png" style="width: 20px;" /> Sair </a>
                    </li>

                <?php } else { ?>

                    <li>
                        <a href="<?= HOME; ?>/login"> <img src="<?= INCLUDE_PATH; ?>/img/glyph-log-in.png" style="width: 20px;" /> Entrar </a>
                    </li>

                <?php } ?>

            </ul>
        </div>
    </div>
</nav>