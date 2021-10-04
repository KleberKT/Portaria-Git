<?php
	@$id 	= $_GET["id"];
	@$acao	= $_GET["acao"];
	@$ordem	= $_GET["ordem"];

	if ($id) {

		$portaria 	= select("portaria", "id = $id");

		$nome 		= $portaria[0]["nome"];
		$docto 		= $portaria[0]["docto"];
		$lancado	= $portaria[0]["lancado"];
		$porte_peq	= $portaria[0]["porte_peq"];
		$data_che	= (strtotime($portaria[0]["data_che"])?date("Y-m-d\TH:i",strtotime($portaria[0]["data_che"])):"");
		$data_entLb	= (strtotime($portaria[0]["data_ent"])?date("d-m-Y H:i",strtotime($portaria[0]["data_ent"])):"EM BRANCO");
		$data_saiLb	= (strtotime($portaria[0]["data_sai"])?date("d-m-Y H:i",strtotime($portaria[0]["data_sai"])):"EM BRANCO");
		$motorista 	= $portaria[0]["motorista"];
		$rg 		= $portaria[0]["rg"];
		$cpf 		= $portaria[0]["cpf"];
		$veiculo 	= $portaria[0]["veiculo"];
		$placa 		= $portaria[0]["placa"];
		$obs 		= $portaria[0]["obs"];
	}

	$habilita = ($acao == "Excluir"?"disabled":"");
	$autofocus= ($acao == "Cadastrar"?"autofocus":"");

	if (isset($_POST["enviado"])) {

		@$url_sucesso 	= URL_BASE . "index.php?link=2&ordem=$ordem";
		@$url_erro 		= URL_BASE . "index.php?link=22";

		$data 	= date("Y-m-d\TH:i");

		if ($acao == "Cadastrar") {
			$data_che 	= $data;
		} else {
			$data_che	= $portaria[0]["data_che"];
		}

		$dados 	= array("nome"		=> strtoupper(@$_POST["nome"]),
						"docto"		=> strtoupper(@$_POST["docto"]),
						"lancado"	=> strtoupper(@$_POST["lancado"]),
						"porte_peq"	=> strtoupper(@$_POST["porte_peq"]),
						"data_che"	=> $data_che,
						"motorista" => strtoupper(@$_POST["motorista"]),
						"rg" 		=> strtoupper(@$_POST["rg"]),
						"cpf" 		=> strtoupper(@$_POST["cpf"]),
						"veiculo"	=> strtoupper(@$_POST["veiculo"]),
						"placa"		=> strtoupper(@$_POST["placa"]),
						"obs"		=> strtoupper(@$_POST["obs"])
		);

		$op = false;
		
		if ($acao == "Cadastrar") {
			$op = insert("portaria", $dados);
		} elseif ($acao == "Editar") {
			$op = update("portaria", $dados, "id = $id");
		} elseif ($acao == "Excluir") {
			$op = delete("portaria", "id = $id");
		} 

		if ($op) {
			print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_sucesso'>";
		} else {
			print "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=$url_erro'>
			<script type = 'text/javascript'> alert('Operação NÃO REALIZADA !!!') </script>";
		}
	}	
?>

<h2>PORTARIA - <?php echo $acao ?></h2>

<div class="formulario">

	<form action="" method="post">

		<div class="col1">
			<label>Nome</label>
			<input type="text" required="required" <?php echo @$autofocus ?> name="nome" id="nome" <?php echo @$habilita ?> value="<?php echo @$nome ?>">
		</div>
		<div class="col2">
			<label>Docto</label>
			<input type="text" required="required" name="docto" id="docto" <?php echo @$habilita ?> value="<?php echo @$docto ?>">
		</div>

		<?php
			if ($acao != "Cadastrar") {
		?>
		<div class="col1">
			<label>Dt Entrada</label>
			<label><?php echo @$data_entLb ?></label>
		</div>

		<div class="col2">
			<label>Dt Saída</label>
			<label><?php echo @$data_saiLb ?></label>
		</div>
		<?php } ?>

		<div>
			<label>Pré Nota</label>
			<select name="lancado" id="lancado" <?php echo $habilita ?> class="tm3">
				<option value="N" <?php echo (@$lancado == 'N') ? "selected" : "" ?>>Não</option>
				<option value="S" <?php echo (@$lancado == 'S') ? "selected" : "" ?>>Sim</option>
	  		</select>
		</label>

		<div>
			<label>Porte Peq.</label>
			<select name="porte_peq" id="porte_peq" <?php echo $habilita ?> class="tm3">
				<option value="N" <?php echo (@$porte_peq == 'N') ? "selected" : "" ?>>Não</option>
				<option value="S" <?php echo (@$porte_peq == 'S') ? "selected" : "" ?>>Sim</option>
	  		</select>
		</label>

		<div class="col1">
			<label>Motorista</label>
			<input type="text" name="motorista" id="motorista" <?php echo @$habilita ?> value="<?php echo @$motorista ?>">
		</div>

		<div class="col2">
			<label>CPF</label>
			<input type="text" name="cpf" id="cpf" <?php echo @$habilita ?> value="<?php echo @$cpf ?>">
		</div>

		<div class="col1">
			<label>CNH</label>
			<input type="text" name="rg" id="rg" <?php echo @$habilita ?> value="<?php echo @$rg ?>">
		</div>
		<!--
		<div class="col2">
			<label>Veículo</label>
			<input type="text" name="veiculo" id="veiculo" <?php echo @$habilita ?> value="<?php echo @$veiculo ?>">
		</div>-->		

		<div class="col2">
			<label>Placa</label>
			<input type="text" name="placa" id="placa" <?php echo @$habilita ?> value="<?php echo @$placa ?>">
		</div>

		<div class="col2">
			<label>
        		<strong>Observações</strong>
        		<textarea  name="obs" id="obs" <?php echo @$habilita ?> rows="15" cols="70"><?php echo @$obs ?></textarea>
			</label>
		</div>
			
		<input type="hidden" name="enviado" value="ok">
		<input type="submit" value="GRAVAR" class="but-salvar">

		<div class="but-cancelar">
			<a href="index.php?link=2&ordem=<?php echo $ordem ?>">CANCELAR</a>
		</div>

	</form>

</div>