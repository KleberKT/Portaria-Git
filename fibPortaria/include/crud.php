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