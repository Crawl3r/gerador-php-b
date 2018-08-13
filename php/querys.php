<?php

class crud {
	
	private $mes;

    public function __construct() {
        
        //db = 'grupovilario_com_br_3';
        //$user = "grupovilari3";
        //$pass = "vilario12@";
		//$host = "mysql.grupovilario.com.br";
		
		$this->mes = date("m");
        
        $db = 'db_aleatorio';
        $user = 'root';
        $pass = '';
		$host = 'localhost';

        try {
            $this->pdo = new PDO('mysql:host='.$host.';dbname='.$db.'', $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function __call($name, $argument) {

        if (method_exists($this, $name)) {
            return call_user_func_array(array($this, $name), $argument);
        } else {
            throw new Exception("Método Não Acessível!", 1);
        }
    }

    // MÉTODO DE LOGIN (NÃO ESTÁ SENDO USADO NO MOMENTO)
    // --------------------------------------------
    private function chk_login($info) {

        //$info['senha'] = crypt($info['senha'],'estacionamento');

        $select = $this->pdo->prepare("SELECT * FROM tb_usuario WHERE login_usuario = ? AND senha_usuario = ?");

        $select->bindParam(1, $info['login'], PDO::PARAM_INT);
        $select->bindParam(2, $info['senha'], PDO::PARAM_INT);

        $select->execute();
        
        return $select->fetchAll();
    }

    //MÉTODO DINÂMICO DE INSERÇÃO SQL
    //
    //$nome_tabela  : nome da tabela sem o 'tb_'
    //$info         : vetor ordenado de informações a serem inseridas          
    //
    //obs.: os indices do vetor devem ser o nome do respectivo campo
    //      sem o '_tabela'
    //
    private function pdo_cadastro($nome_tabela, $info) {

        //montagem da query dinâmica
        $cont_param = 0;
        $sql = "INSERT INTO tb_$nome_tabela(";

        foreach ($info as $index => $key) {
            $sql .= $index . "" . $nome_tabela . ", ";
            $cont_param += 1;
        }

        $sql = substr_replace($sql, "", -2);
        $sql .= ") VALUES (";

        for ($i = 0; $i < $cont_param; $i++) {
            $sql .= "?,";
        }

        $sql = substr_replace($sql, "", -1);
        $sql .= ")";
        //---------------------------------
        //execução da query
        try {
            $prepara = $this->pdo->prepare($sql);

            $controle = 1;
            foreach ($info as $index => $key) {
                $prepara->bindParam($controle, $info[$index], PDO::PARAM_INT);
                $controle += 1;
            }

            $prepara->execute();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    //MÉTODO DINÂMICO DE EDIÇÃO SQL
    //
    //$nome_tabela  : nome da tabela sem o 'tb_'
    //$info         : vetor ordenado de informações a serem inseridas          
    //$campo_id     : nome do campo do código identificador
    //
    //obs.: os indices do vetor devem ser o nome do respectivo campo
    //      sem o '_tabela'
    //
    private function pdo_edit($nome_tabela, $info, $campo_id) {

        //montagem da query dinâmica
        $cont_param = 0;
        $sql = "UPDATE tb_$nome_tabela SET ";

        foreach ($info as $index => $key) {
            if ($index !== $campo_id) {
                $sql .= $index . "" . $nome_tabela . " = ?, ";
                $cont_param += 1;
            }
        }

        $sql = substr_replace($sql, "", -2);
        $sql .= " WHERE " . $campo_id . "" . $nome_tabela . " = ?";
        //---------------------------------

        try {
            $prepara = $this->pdo->prepare($sql);

            $controle = 1;
            foreach ($info as $index => $key) {
                if ($index !== $campo_id) {
                    $prepara->bindParam($controle, $info[$index], PDO::PARAM_INT);
                    $controle += 1;
                }
            }

            $prepara->bindParam($controle, $info[$campo_id], PDO::PARAM_INT);

            $prepara->execute();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    //MÉTODO DINÂMICO DE SELEÇÃO SQL
    //
    //$nome_tabela  : nome da tabela sem o 'tb_'         
    //$campo_id     : cndição de pesquisa como 'WHERE id = 1'
    //
    private function pdo_src($nome_tabela, $condicao) {

        $select = $this->pdo->query("SELECT * FROM tb_$nome_tabela $condicao ");
        return $select->fetchAll();
    }
    
    //MÉTODO DINÂMICO DE REMOÇÃO SQL
    //
    //$nome_tabela  : nome da tabela sem o 'tb_'         
    //$campo_id     : cndição de pesquisa como 'WHERE id = 1'
    //
    private function pdo_delete($nome_tabela, $id) {

        $this->pdo->query("DELETE FROM tb_$nome_tabela WHERE id_$nome_tabela = $id ");
        
    }
    
    private function pdo_src_c($condicao) {
        
        //echo "<pre>";
        $sql = "SELECT "
                . "tb_chamado.*, "
                . "func_a.nome_usuario as func_a_n, "
                . "func_f.nome_usuario as func_f_n, "
                . "tb_empresa.nome_empresa "
                . "FROM tb_chamado "
                . "INNER JOIN "
                . "tb_usuario as func_a ON tb_chamado.id_func_a_chamado = func_a.id_usuario "
                . "LEFT JOIN "
                . "tb_usuario as func_f ON tb_chamado.id_func_f_chamado = func_f.id_usuario "
                . "INNER JOIN "
                . "tb_empresa ON tb_chamado.id_emp_chamado = tb_empresa.id_empresa"
                . " $condicao ";

        $select = $this->pdo->query($sql);
        //echo $sql;
        return $select->fetchAll();
    }
    
    private function pdo_src_l($condicao) {
        
        //echo "<pre>";
        $sql = "SELECT "
                . "tb_lanc.*, "
                . "tb_contrato.*, "
                . "func_a.nome_usuario as func_a_n "
                . "FROM tb_lanc "
                . "INNER JOIN "
                . "tb_usuario as func_a ON tb_lanc.id_func_l = func_a.id_usuario "
                . "INNER JOIN "
                . "tb_contrato ON tb_lanc.id_contrato = tb_contrato.id_contrato"
                . " $condicao ";

        $select = $this->pdo->query($sql);
        //echo $sql;
        return $select->fetchAll();
    }
    
     private function pdo_src_escala($mes) {
        
        //echo "<pre>";
        $sql = "SELECT "
                . "f.nome_funcionario, "
                . "f.cargo_funcionario,"
                . "f.empresa_funcionario, "
                . "es.* "
                . "FROM tb_funcionario as f "
                . "INNER JOIN tb_escala as es ON "
                . "es.id_funcionario_escala = f.id_funcionario "
                . "WHERE "
                . "es.mes_escala = '" . $mes . "/" . date('Y') . "' ";
        
        //echo $sql."<br />";
        $select = $this->pdo->query($sql);
        return $select->fetchAll();
    }
    
    private function query_void($query) {
        
        $select = $this->pdo->query($query);
        //return $select->fetchAll();
    }
	
	private function query($query) {
        
        $select = $this->pdo->query($query);
        return $select->fetchAll();
    }
    
    private function edita_senha($id,$senha){
		
		try{
			$prepara = $this->pdo->prepare("
			UPDATE tb_usuario
			SET
				senha_usuario = ?
			WHERE
				id_usuario = ?
			
			");
			
			$prepara->bindParam(1, $senha, PDO::PARAM_INT );
			$prepara->bindParam(2, $id, PDO::PARAM_INT );
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}
    
    private function bloq_usuario($id,$status){
		
		try{
			$remove = $this->pdo->query("
				UPDATE tb_usuario 
				SET
					ativo_usuario = '".$status."'
				WHERE 
					id_usuario = '".$id."' 
			");
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}
    
    private function edita_usuario($info){
		
		try{
			$prepara = $this->pdo->prepare("
			UPDATE tb_usuario
			SET
                nome_usuario = ?,
				login_usuario = ?,
                setor_usuario = ?
			WHERE
				id_usuario = ?
			
			");
			
            $prepara->bindParam(1, $info['nome'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['login'], PDO::PARAM_INT );
            $prepara->bindParam(3, $info['setor'], PDO::PARAM_INT );
			$prepara->bindParam(4, $info['id'], PDO::PARAM_INT );
			
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}
    
    function cadastra_usuario($info){
		
		try{
			$prepara = $this->pdo->prepare("
			INSERT INTO tb_usuario
			(	
                nome_usuario,
				login_usuario,
				senha_usuario,
                nivel_usuario,
                setor_usuario,
                ativo_usuario
				
			) 
			VALUES 
			(
				?,?,?,'usuario',?,1
			)
			
			");
			
            $prepara->bindParam(1, $info['nome'], PDO::PARAM_INT );
			$prepara->bindParam(2, $info['login'], PDO::PARAM_INT );
			$prepara->bindParam(3, $info['senha'], PDO::PARAM_INT );
            $prepara->bindParam(4, $info['setor'], PDO::PARAM_INT );
            
			$prepara->execute();
			
		}catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
	    	die();
		}
		
	}
    
    //MÉTODO DINÂMICO DE INSERÇÃO SQL CAMPO LIVRE
    //
    //$nome_tabela  : nome da tabela sem o 'tb_'
    //$info         : vetor ordenado de informações a serem inseridas          
    //
    //obs.: os indices do vetor devem ser o nome do respectivo campo
    //      sem o '_tabela'
    //
    private function pdo_cadastro_l($nome_tabela, $info) {

        //montagem da query dinâmica
        $cont_param = 0;
        $sql = "INSERT INTO tb_$nome_tabela(";

        foreach ($info as $index => $key) {
            $sql .= $index . ", ";
            $cont_param += 1;
        }

        $sql = substr_replace($sql, "", -2);
        $sql .= ") VALUES (";

        for ($i = 0; $i < $cont_param; $i++) {
            $sql .= "?,";
        }

        $sql = substr_replace($sql, "", -1);
        $sql .= ")";
        
        //echo $sql;
        //---------------------------------
        //execução da query
        try {
            $prepara = $this->pdo->prepare($sql);

            $controle = 1;
            foreach ($info as $index => $key) {
                $prepara->bindParam($controle, $info[$index], PDO::PARAM_INT);
                $controle += 1;
            }

            $prepara->execute();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    //MÉTODO DINÂMICO DE EDIÇÃO SQL CAMPO LIVRE
    //
    //$nome_tabela  : nome da tabela sem o 'tb_'
    //$info         : vetor ordenado de informações a serem inseridas          
    //$campo_id     : nome do campo do código identificador
    //
    //obs.: os indices do vetor devem ser o nome do respectivo campo
    //      sem o '_tabela'
    //
    private function pdo_edit_l($nome_tabela, $info, $campo_id) {

        //montagem da query dinâmica
        $cont_param = 0;
        $sql = "UPDATE tb_$nome_tabela SET ";

        foreach ($info as $index => $key) {
            if ($index !== $campo_id) {
                $sql .= $index . " = ?, ";
                $cont_param += 1;
            }
        }

        $sql = substr_replace($sql, "", -2);
        $sql .= " WHERE " . $campo_id . " = ?";
        //---------------------------------

        try {
            $prepara = $this->pdo->prepare($sql);

            $controle = 1;
            foreach ($info as $index => $key) {
                if ($index !== $campo_id) {
                    $prepara->bindParam($controle, $info[$index], PDO::PARAM_INT);
                    $controle += 1;
                }
            }

            $prepara->bindParam($controle, $info[$campo_id], PDO::PARAM_INT);

            $prepara->execute();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }


}
