<?php
require './_app/Config.inc.php';
if($_POST){
    $_SESSION['post_data'] = $_POST;
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="initial-scale=1.0">
        <title>Grupo Vila</title>

        <script src="./_cdn/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css" href="<?= INCLUDE_PATH; ?>/css/bootstrap-3.3.7/dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?= INCLUDE_PATH; ?>/css/bootstrap-3.3.7/dist/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="<?= INCLUDE_PATH; ?>/css/bootstrap-datepicker.css" >
        <link rel="stylesheet/less" type="text/css" href="<?= INCLUDE_PATH; ?>/css/cinza-azul.less">


        <script src="_cdn/less.js/dist/less.js" type="text/javascript"></script>
        <script src="_cdn/bootstrap.min.js"></script>
        <script src="_cdn/bootstrap-datepicker.js"></script>
        <script src="_cdn/bootstrap-datepicker.pt-BR.min.js"></script>
        <script src="_cdn/ativo.js"></script>

        <script src="_cdn/jqmask/src/jquery.mask.js"></script>

        <script>
            $(document).ready(function () {
                $('.i-cep').mask('00000-000');
                $('.i-fone').mask('(00)0000-0000');
                $('.i-cel').mask('(00)00000-0000');
                $('.i-cpf').mask('000.000.000-00');
                $('.i-data').mask('00/00/0000');
                $('.i-mesano').mask('00/0000');
            });
        </script>

        <script>
            jQuery(document).ready(function ($) {
                $(".clickable-row").click(function () {
                    window.location = $(this).data("href");
                });
            });
        </script>

        <style>
            .clickable-row{
                cursor: pointer;
            }
            .input-small{
                max-width: 120px;
            }
        </style>

    </head>
    <body>
        <?php
        //MENU SUPERIOR
        require REQUIRE_PATH . "/inc/menu.php";
        //MENU SUPERIOR
        
        //CONTEÚDO
        if($Url[0]!=='cracha_impr'){
            
            $Url[1] = (empty($Url[1]) ? HOME : $Url[1]);
            if (file_exists(REQUIRE_PATH . '/' . $Url[0] . '.php')):
                require REQUIRE_PATH . '/' . $Url[0] . '.php';
            else:
                require REQUIRE_PATH . '/404.php';
            endif;
            
        }else{
            echo '<script>window.location.href="' . HOME . '/cracha_impr.php";</script>';
        }
        //CONTEÚDO
        
        //FOOTER
        require REQUIRE_PATH . "/inc/footer.php";
        //FOOTER
        ?>
    </body>
</html>


