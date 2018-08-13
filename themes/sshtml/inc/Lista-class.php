<?php

class lista_index extends crud {

    public function desenha_aberta($campo,$valor) {
        
        if($campo!=='' && $valor!==''){
            $chamados = $this->pdo_src_c("WHERE $campo LIKE '%$valor%' and status_chamado = 'aberto' ORDER BY status_chamado DESC, d_h_a_chamado ASC");
        }else{
            $chamados = $this->pdo_src_c("WHERE status_chamado = 'aberto' ORDER BY status_chamado ASC, d_h_a_chamado DESC");
        }
        

        $resp = "
            <div class='panel panel-default'>
                <div style='font-size: 14pt' class='panel-heading'></div>
                <div class='panel-body'>
                    <div class='table-responsive'>
                        <table class='table table-striped table-hover'>
                            <thead>
                                <tr>
                                    <th>
                                        Status:
                                    </th>
                                    <th class=text-primary>
                                       Requerente:
                                    </th>
                                    <th>
                                        Aberto por:
                                    </th>
                                    <th>
                                        Abertura:
                                    </th>
                                    <th class=text-primary>
                                        Categoria:
                                    </th>
                                    <th class=text-primary>
                                        Empresa:
                                    </th>
                                    <th>
                                        Desc:
                                    </th>
                                    <th>
                                        Responsável:
                                    </th>
                                    <th>
                                        Encerramento:
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
        ";
        if($chamados!==array()) {

            foreach ($chamados as $key) {
                $resp .= "<tr ";
                if ($key['status_chamado'] === 'aberto') {
                    $resp .= 'class=\'clickable-row danger text-danger\' ';
                } else {
                    $resp .= 'class=\'clickable-row info\' ';
                }
                $resp .= "data-href='" . HOME . '/edita_chamado?id_c=' . $key['id_chamado'] . "' >";

                $resp .= "<td>" . ucfirst($key['status_chamado']) . "</td>";
                
                if ($key['status_chamado'] === 'aberto') {
                    $resp .= "<td class=text-danger style=\"white-space: nowrap;\"><b>";
                }else{
                    $resp .= "<td class=text-primary style=\"white-space: nowrap;\"><b>";
                }
                $resp .= ucfirst($key['func_alvo_chamado']) . "</b></td>";

                $resp .= "<td>" . $key['func_a_n'] . "</td>";

                $resp .= "<td>";
                $dh = explode(' ', $key['d_h_a_chamado']);
                $resp .= implode('/', array_reverse(explode('-', $dh[0])));
                $resp .= ' às ';
                $resp .= $dh[1];
                $resp .= "</td>";
                
                if ($key['status_chamado'] === 'aberto') {
                    $resp .= "<td class=text-danger><b>";
                }else{
                    $resp .= "<td class=text-primary><b>";
                }
                $resp .= $key['categoria_chamado'];
                $resp .= "</b></td>";
                
                if ($key['status_chamado'] === 'aberto') {
                    $resp .= "<td class=text-danger style=\"white-space: nowrap;\"><b>";
                }else{
                    $resp .= "<td class=text-primary style=\"white-space: nowrap;\"><b>";
                }
                $resp .= $key['nome_empresa'] . "</b></td>";
                
                $key['desc_chamado'] = substr($key['desc_chamado'], 0, 70);
                if( strlen($key['desc_chamado']) >= 70 ){
                    $key['desc_chamado'] .= "...<a>(Leia Mais)</a>";
                }
                
                $resp .= "<td>" . $key['desc_chamado'] . "</td>";

                $resp .= "<td>" . $key['func_f_n'] . "</td>";

                $resp .= "<td>";
                if ($key['d_h_f_chamado'] !== '0000-00-00 00:00:00') {
                    $dh = explode(' ', $key['d_h_f_chamado']);
                    $resp .= implode('/', array_reverse(explode('-', $dh[0])));
                    $resp .= ' às ';
                    $resp .= $dh[1];
                }
                $resp .= "</td></tr>";
            }
        } else {
            $resp .= "<tr class=danger><td colspan=9>Nenhum chamado Registrado</td></tr>";
        }


        $resp .= " </tbody>
            </table>
            </div>
            </div>
            </div>
            ";

        return $resp;
    }
	
	public function desenha_fechada($campo,$valor) {
        
        if($campo!=='' && $valor!==''){
            $chamados = $this->pdo_src_c("WHERE $campo LIKE '%$valor%' and status_chamado = 'fechado' ORDER BY status_chamado DESC, d_h_a_chamado ASC");
        }else{
            $chamados = $this->pdo_src_c("WHERE status_chamado = 'fechado' ORDER BY status_chamado ASC, d_h_a_chamado DESC");
        }
        

        $resp = "
            <div class='panel panel-default'>
                <div style='font-size: 14pt' class='panel-heading'></div>
                <div class='panel-body'>
                    <div class='table-responsive'>
                        <table class='table table-striped table-hover'>
                            <thead>
                                <tr>
                                    <th>
                                        Status:
                                    </th>
                                    <th class=text-primary>
                                       Requerente:
                                    </th>
                                    <th>
                                        Aberto por:
                                    </th>
                                    <th>
                                        Abertura:
                                    </th>
                                    <th class=text-primary>
                                        Categoria:
                                    </th>
                                    <th class=text-primary>
                                        Empresa:
                                    </th>
                                    <th>
                                        Desc:
                                    </th>
                                    <th>
                                        Responsável:
                                    </th>
                                    <th>
                                        Encerramento:
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
        ";
        if($chamados!==array()) {

            foreach ($chamados as $key) {
                $resp .= "<tr ";
                if ($key['status_chamado'] === 'aberto') {
                    $resp .= 'class=\'clickable-row danger text-danger\' ';
                } else {
                    $resp .= 'class=\'clickable-row info\' ';
                }
                $resp .= "data-href='" . HOME . '/edita_chamado?id_c=' . $key['id_chamado'] . "' >";

                $resp .= "<td>" . ucfirst($key['status_chamado']) . "</td>";
                
                if ($key['status_chamado'] === 'aberto') {
                    $resp .= "<td class=text-danger style=\"white-space: nowrap;\"><b>";
                }else{
                    $resp .= "<td class=text-primary style=\"white-space: nowrap;\"><b>";
                }
                $resp .= ucfirst($key['func_alvo_chamado']) . "</b></td>";

                $resp .= "<td>" . $key['func_a_n'] . "</td>";

                $resp .= "<td>";
                $dh = explode(' ', $key['d_h_a_chamado']);
                $resp .= implode('/', array_reverse(explode('-', $dh[0])));
                $resp .= ' às ';
                $resp .= $dh[1];
                $resp .= "</td>";
                
                if ($key['status_chamado'] === 'aberto') {
                    $resp .= "<td class=text-danger><b>";
                }else{
                    $resp .= "<td class=text-primary><b>";
                }
                $resp .= $key['categoria_chamado'];
                $resp .= "</b></td>";
                
                if ($key['status_chamado'] === 'aberto') {
                    $resp .= "<td class=text-danger style=\"white-space: nowrap;\"><b>";
                }else{
                    $resp .= "<td class=text-primary style=\"white-space: nowrap;\"><b>";
                }
                $resp .= $key['nome_empresa'] . "</b></td>";
                
                $key['desc_chamado'] = substr($key['desc_chamado'], 0, 70);
                if( strlen($key['desc_chamado']) >= 70 ){
                    $key['desc_chamado'] .= "...<a>(Leia Mais)</a>";
                }
                
                $resp .= "<td>" . $key['desc_chamado'] . "</td>";

                $resp .= "<td>" . $key['func_f_n'] . "</td>";

                $resp .= "<td>";
                if ($key['d_h_f_chamado'] !== '0000-00-00 00:00:00') {
                    $dh = explode(' ', $key['d_h_f_chamado']);
                    $resp .= implode('/', array_reverse(explode('-', $dh[0])));
                    $resp .= ' às ';
                    $resp .= $dh[1];
                }
                $resp .= "</td></tr>";
            }
        } else {
            $resp .= "<tr class=danger><td colspan=9>Nenhum chamado Registrado</td></tr>";
        }


        $resp .= " </tbody>
            </table>
            </div>
            </div>
            </div>
            ";

        return $resp;
    }

}
