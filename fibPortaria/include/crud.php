<?php
	function open() {
		$conexao = @mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO) or die(mysqli_connect_error());
		@mysqli_set_charset($conexao, CHARSET);
		return $conexao;
	}

	function close($conexao) {
		@mysqli_close($conexao) or die (@mysqli_error($conexao));
	}

	function execute ($sql, $id = false) {
		$conexao = open();
		$qry = @mysqli_query($conexao, $sql) or die(@mysqli_error($conexao));
		
		if ($id)
			$qry = mysqli_insert_id($conexao);

		close($conexao);
		return $qry;
	}

	function select ($tabela, $condicao=null, $campos="*") {
		if ($condicao != null) {
			$condicao = " WHERE " . $condicao;
		}
		$sql = "SELECT {$campos} FROM {$tabela} {$condicao} ";

		//var_dump($sql);

		$qry = execute($sql);
		if (!@mysqli_num_rows($qry)) {
			return false;
		} else {
			while ($linha = @mysqli_fetch_array($qry)) {
				$dados[] = $linha;
			}
			return $dados;
		}
	}

	function selectsql ($sql) {
		$qry = execute($sql);
		if (!mysqli_num_rows($qry)) {
			return false;
		} else {
			while ($linha = @mysqli_fetch_assoc($qry)) {
				$dados[] = $linha;
			}
		return $dados;	
		}
	}

	function insert ($tabela, array $dados, $id = false) {
		$dados = escapa($dados);
		$campos = implode(", ", array_keys($dados));
		$valores = "'" . implode("', '", $dados) . "'";
		$sql = "INSERT INTO $tabela ({$campos}) VALUES ({$valores}) ";
		return execute($sql, $id);
	}

	function update ($tabela, array $dados, $condicao) {
		$dados = escapa($dados);
		foreach ($dados as $chave => $valor) {
			$campos[] = "{$chave} = '{$valor}' ";
		}	
		$campos = implode(", ", $campos);
		$sql = "UPDATE {$tabela} SET {$campos} WHERE {$condicao}";
		return execute($sql);
	}

	function delete ($tabela, $condicao) {
		$sql = "DELETE FROM {$tabela} WHERE {$condicao}";
		return execute($sql);
	}

	function numrows ($tabela, $condicao=null) {
		$sql = "SELECT * FROM {$tabela} {$condicao}";
		//var_dump($sql);
		$qry = execute($sql);
		return mysqli_num_rows($qry);
	}

	function escapa($data) {
		$link = open();
		//var_dump($data);
		if (!is_array($data))
			$dados = mysqli_real_escape_string($link, $data);
		else {
			$arr = $data;

			foreach ($arr as $key => $value) {
				$key 	= mysqli_real_escape_string($link, $key);
				$value 	= mysqli_real_escape_string($link, $value);

				$data[$key] = $value; 
			}
		}
		//var_dump($data);
		close($link);
		return $data;
    }
?>