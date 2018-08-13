<div id="iframeHolder" class="iframe_embed">
</div>
<?php
date_default_timezone_set('America/Sao_Paulo');
//protege de entrada sem login
if ($_SESSION == array()) {

    if (@$_SESSION['nivel_usuario'] != 'adm') {
        require REQUIRE_PATH . "/inc/frame_home.php";
    }
} else {
?>
<?php

	if(isset($_GET['valor']) && $_GET['valor'] !== ""){
		
		$valores = explode(",",$_GET['valor']);
		$rasultado = array();
		
		for($i = 0; $i < 100; $i++){
			
			$result = array();
			$repetidos = array();
			$cont = 0;
			
			while(true){
			//for($j = 0; $j < 100; $j++){
				
				$index = rand(0,count($valores)-1);
				
				if(!in_array($valores[$index], $repetidos)){
					
					++$cont;
					$result[]  = $valores[$index];
					$repetidos[] = $valores[$index];
					
				}
				
				if($cont >= 10){
					break;
				}
				
			}
			
			$resultado[] = $result;
			
		}
		
		$resultado = array_unique($resultado,SORT_REGULAR);
		
		//prepara para salvar no txt
		$data = date('d-m-Y-H-i-s');
		$txt  = $data . "\r\n\r\n"; 
		foreach($resultado as $index => $key){
			$bar  = "Jogo Nr°" . sprintf("%03d", $index+1) . " -- ";
			//$bar = "";
			foreach($key as $foo){
				$bar .= $foo . " - "; 
			}
			$bar  = substr($bar,0,-3);
			$txt .=  $bar."\r\n";
			$bar  = "";
		} 
		
		/*
		$myfile = fopen("./jogos/jogo-$data.txt", "w");
		fwrite($myfile, $txt);
		fclose($myfile);
		*/
		
		file_put_contents("./jogos/jogo-$data.txt", $txt);
		
	}
?>
	<?php if (@$_SESSION['setor_usuario'] != "Operacional") { ?>
		<div class='container-fluid'>
			<div class='panel panel-default'>
				<div style='font-size: 14pt' class='panel-heading'>Geração</div>
				<div class='panel-body'>
					<form class="form form-horizontal" method="GET" action="<?= HOME ?>" >
						<input required class="form-control" type="text" id='numeros' name="valor" placeholder="Valores separados por vírgula. Ex.: 01,23,45,...,n." />
						<button type="submit" class="btn btn-primary btn-block" style="margin-top: -10px">Gerar</button>
					</form>
				</div>
			</div>
		</div>
		<div class='container-fluid'>
			<div class='panel panel-default'>
				<div style='font-size: 14pt' class='panel-heading'>Resultado</div>
				<div class='panel-body' id='resultado'>
				 <?php 
				 if(isset($resultado)){
					foreach($resultado as $index => $key){
						$bar  = "Jogo Nr°" . sprintf("%03d", $index+1) . " -- ";
						//$bar = "";
						foreach($key as $foo){
							$bar .= $foo . " - "; 
						}
						$bar = substr($bar,0,-3);
						echo $bar."<br>";
						$bar = "";
					} 
				 }
				?>
				</div>
			</div>
		</div>
    <?php }?>
<?php } ?>



